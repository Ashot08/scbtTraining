const app = new Vue({
    el: document.getElementById('mbl-test-create-app'),
    template: `
    <div class="mbl-test-editor">
      <ul class="mbl-test-question">
        <li v-if="questions.length > 1" class="show-hide-links">
          <button class="button" @click.prevent="showAll"><i class="fa fa-caret-square-o-down"></i>{{ translations.showAll }}</button>
          <button class="button" @click.prevent="hideAll"><i class="fa fa-caret-square-o-up"></i>{{ translations.hideAll }}</button>
        </li>
        <li v-for="(question, i) in questions" :key="i" :class="{active: question.isEdited}">
        
          <input v-model="question.type" :name="'page_meta[test][test_questions]['+i+'][type]'" style="display: none">
            
          <div class="mbl-test-row mbl-test-question-header">
          
            <div class="mbl-test_question-number" :class="{'single': question.type=='single'}">
               #{{ i + 1 }}
            </div>
            
            <button v-if="!question.isEdited" class="button" @click.prevent="question.isVisible = !question.isVisible">
               <i v-if="!question.isVisible" class="fa fa-caret-square-o-down"></i>
               <i v-else class="fa fa-caret-square-o-up"></i>
               {{ !question.isVisible ? translations.showQuestion : translations.hideQuestion}}
            </button>
            
            <button v-if="!question.isEdited" class="button" @click.prevent="question.isEdited = !question.isEdited, editorInit(i)">
               <i class="fa fa-pencil-square"></i>
               {{ translations.editQuestion }}
            </button>
            
            <button class="button" @click.prevent="deleteQuestion(i)" style="margin-left: auto">
               <i class="fa fa-trash-o"></i>
               {{ translations.removeQuestion }}
            </button>
          </div>
          
          <div v-show="!question.isEdited" v-html="question.text" class="question-text"></div>
          
          <div v-show="question.isEdited" class="bootstrap-admin-wrap" style="font-weight: normal">
            <textarea 
              v-model="question.text"
              :ref="'question_'+i"
              :id="'question_'+i"
              :name="'page_meta[test][test_questions]['+i+'][text]'"
            ></textarea>
          </div>
          
          <div v-show="question.isVisible || question.isEdited" class="mbl-test-answers-list">
            {{ translations.answers }}
            <answers-list
              :type="question.type"
              :answers="question.answers"
              :question="i"
              :edit="question.isEdited"
              :tiny-options="tinyOptions"
              :translations="translations"
            />
          </div>
          
          <div class="mbl-test-row question-footer">
            <button v-if="question.isEdited" class="button" @click.prevent="addAnswer(i)">
              <i class="fa fa-plus-square-o"></i>
               {{ translations.addAnswer }}
            </button>
            <button v-if="question.isEdited" class="button" @click.prevent="addAnswer(i, 'custom')" :disabled="hasCustomAnswer(i)">
               <i class="fa fa-plus-square-o"></i>
               {{ translations.youAnswer }}
            </button>
            <button v-if="question.isEdited" class="button" @click.prevent="question.isEdited=!question.isEdited, cancelQuestion(i)"  style="margin-left: auto">
               {{ translations.cancel }}
            </button>
            <button v-if="question.isEdited" class="button" @click.prevent="question.isEdited=!question.isEdited, saveQuestion(i)">
               {{ translations.saveQuestion }}
            </button>
          </div>
        </li>
      </ul>
      
      <div class="mbl-test-row add-question-row">
          <span>
              {{ translations.addQuestion }}
          </span>
          <button id="mbl-test-question-single-create" class="button" @click.prevent="addQuestion('single')">
              <i class="fa fa-dot-circle-o"></i>
              {{ translations.singleQuestion }}
          </button>
          <button id="mbl-test-question-multiple-create" class="button" @click.prevent="addQuestion('multiple')">
              <i class="fa fa-check-square"></i>
              {{ translations.multipleQuestion }}
          </button>
      </div>
      
    </div>
  `,
    data: {
        questions: [],
        translations: {}
    },
    mounted: function () {
        try {
            this.questions = JSON.parse(window.mbl_tests.test_questions) || [];
        }
        catch(e) {
            console.log('Can"t parse JSON');
        }

        this.translations = window.mbl_tests.translations;

        this.tinyOptions = summernoteOptions || [];

        //this.tinyOptions = JSON.parse(window.mbl_tests.tiny_options) || [];

        //this function sinhronize summernote editors with vue when form submit
        (function ($, _this) {
            $(document).ready(function() {
                $('input[name=save]').on('click', function (e) {
                    //e.preventDefault();
                    _this.questions.map(( q, i ) => {
                        q.text = $(_this.$refs['question_' + i]).summernote('code');
                    });
                });
            });
        })(jQuery, this);

        //clear text if paste
        // this.tinyOptions = Object.assign(this.tinyOptions, {
        //     callbacks: {
        //         onPaste: function (e) {
        //             var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        //             e.preventDefault();
        //             document.execCommand('insertText', false, bufferText);
        //         }
        //     }
        // });

        //add reactive fields to Object
        this.questions.map(q => {
            Vue.set(q, 'isVisible', false);
            Vue.set(q, 'isEdited', false);
            Vue.set(q, 'temp_answers', []);
            if (q.answers) {
                //add reactive key for answers
                q.answers.map(a => {
                    Vue.set(a, 'edit', false);
                })
            } else {
                Vue.set(q, 'answers', []);
            }
        });
    },
    methods: {

        deleteQuestion: function (i) {
            const promptQuestion = confirm(this.translations.removeQuestionPrompt);
            if(promptQuestion) {
                this.questions.splice(i, 1);
            }
        },

        addQuestion: function (type) {
            this.questions.push({
                text: '',
                isVisible: true,
                isEdited: true,
                answers: [],
                type: type == 'multiple' ? 'multiple' : 'single'
            });

            //init editor after rendering element
            Vue.nextTick(() => {
                this.editorInit(this.questions.length - 1)
            })
        },

        editorInit: function (i) {
            (function ($, _this) {
                //add callback to synchronise question object with editor
                $(_this.$refs['question_' + i]).summernote(_this.tinyOptions);
            })(jQuery, this);

            //push answers in temp array to identify changes
            this.questions[i].temp_answers = JSON.stringify(this.questions[i].answers);
        },

        saveQuestion: function (i) {
            //save text from editor
            (function ($, _this) {
                //pass text from editor to text
                _this.questions[i].text = $(_this.$refs['question_' + i]).summernote('code');
                $(_this.$refs['question_' + i]).summernote('destroy');
            })(jQuery, this);

            //this.questions[i].isVisible = false
        },

        cancelQuestion: function (i) {
            (function ($, _this) {
                $(_this.$refs['question_' + i]).summernote('destroy');
            })(jQuery, this);

            //cancel edit answers (restore changes)
            this.questions[i].answers = JSON.parse(this.questions[i].temp_answers);
            this.questions[i].isVisible = false
        },

        addAnswer: function (i, type) {
            let length = this.questions[i].answers.length;
            if (this.hasCustomAnswer(i)) {
                //if custom answer correctly
                if (this.questions[i].answers[0].correctly == length-1 && this.questions[i].type == 'single' ){
                    this.questions[i].answers[0].correctly = this.questions[i].answers[0].correctly + 1
                }
                this.questions[i].answers.splice(length - 1, 0, {
                    text: '',
                    type: '',
                    edit: false,
                    correctly: length===1 && this.questions[i].type == 'single' ? 1 : ''
                });
            } else {
                this.questions[i].answers.push({
                    text: type === 'custom' ? '<p>'+this.translations.customChoise+'</p>' : '',
                    type: type === 'custom' ? 'custom' : '',
                    edit: false,
                    correctly: length===0 ? 0 : ''
                });
            }
        },

        hasCustomAnswer: function (i) {
            let res = false;
            if (!this.questions[i].answers) return res;
            this.questions[i].answers.map((el) => {
                if (el.type === 'custom') {
                    res = true
                }
                return el
            });
            return res;
        },
        showAll: function () {
            this.questions.map(q => {
                q.isVisible = true
            })
        },
        hideAll: function () {
            this.questions.map(q => {
                q.isVisible = false
            })
        }
    }
});

Vue.component('answers-list', {
    template: `
    <ul class="list">
      <li v-for="(answer, i) in answers" :key="i">
      <input 
        v-model="answers[i].type"
        :name="'page_meta[test][test_questions]['+question+'][answers]['+i+'][type]'"
        hidden 
        >
      <span>
        #{{ i+1 }}
      </span>
      <input
        v-if="type == 'single'"
        v-model="answers[0].correctly"
        :name="'page_meta[test][test_questions]['+question+'][answers][0][correctly]'"
        :id="'input_answer_'+question+'_'+i"
        :readonly="!edit"
        :value="i"
        type="radio" 
        class="mbl-test-custom-input" 
      >
      <input 
        v-else
        v-model="answer.correctly"
        :name="'page_meta[test][test_questions]['+question+'][answers]['+i+'][correctly]'"
        :id="'input_answer_'+question+'_'+i"
        :readonly="!edit"
        :value="true"
        type="checkbox"
        class="mbl-test-custom-input" 
      >
        
      <label
        v-if="type == 'single'"
        class="mbl-test-radio green" 
        :for="'input_answer_'+question+'_'+i">
      </label>
      <label
        v-else
        class="mbl-test-checkbox green" 
        :for="'input_answer_'+question+'_'+i">
      </label>
      
      <i v-if="answer.type == 'custom'" class="fa fa-commenting"></i>
      
      <div v-if="!answer.edit" v-html="answer.text" class="mbl-test-answer">

      </div>
      <div v-show="answer.edit" class="bootstrap-admin-wrap" style="font-weight: normal">
        <textarea
          v-model="answer.text" 
          :name="'page_meta[test][test_questions]['+question+'][answers]['+i+'][text]'"
          :ref="'answer_'+question+'_'+i"
          :id="'answer_'+question+'_'+i"
          type="text"
        >
        </textarea>
         <button class="button btn_done" @click.prevent="removeActiveEditor">{{translations.done}}</button>
      </div>
      <button v-show="edit && !answer.edit && answer.type != 'custom'" class="button edit-btn" @click.prevent="editAnswer(i)">
        <i class="fa fa-pencil"></i>
      </button>
      <button v-if="edit" class="button" @click.prevent="remove(i)">
        <i class="fa fa-close"></i>
      </button>
      </li>
     </ul>
  `,
    props: {
        answers: [],
        type: 'single',
        translations: {},
        question: 0,
        edit: false,
        editItem: 0,
        tinyOptions: []
    },
    watch: {
        edit: function (newVal) {
            if (!newVal) {
                this.removeActiveEditor();
            }
        }
    },
    methods: {

        remove: function (i) {
            const promptAnswer = confirm(this.translations.removeAnswerPrompt);
            if(promptAnswer) {
                if ( i === 0 && this.answers[0].correctly == 0 && this.answers.length > 1) {
                    this.answers[1].correctly = 0;
                } else if( i === 0 && this.answers[0].correctly !== 0 && this.answers.length > 1 ){
                    this.answers[1].correctly = this.answers[0].correctly -1
                } else if( i > 0 && i === this.answers[0].correctly){
                    this.answers[0].correctly = 0
                } else if( i > 0 && i < this.answers[0].correctly ){
                    this.answers[0].correctly = this.answers[0].correctly -1
                }
                this.removeActiveEditor();
                this.answers.splice(i, 1);
            }
        },

        editAnswer: function (i) {
            if (!this.edit || this.answers[i].type == 'custom') {
                return
            }

            this.removeActiveEditor();

            this.answers[i].edit = true;

            (function ($, _this) {
                $(_this.$refs['answer_' + _this.question + '_' + i]).summernote(
                    Object.assign({}, _this.tinyOptions, {height: '80'})
                );
            })(jQuery, this);
        },

        removeActiveEditor: function () {
            this.answers.map((el, i) => {

                //remove editor from edited elemets
                if (el.edit) {
                    (function ($, _this) {
                        if (_this.$refs['answer_' + _this.question + '_' + i]) {
                            //el.text = _this.$refs['answer_' + _this.question + '_' + i][0].value;
                            el.text = $(_this.$refs['answer_' + _this.question + '_' + i]).summernote('code')
                            $(_this.$refs['answer_' + _this.question + '_' + i]).summernote('destroy');
                        }
                    })(jQuery, this);
                }

                //change status
                el.edit = false;
                return el
            });
        }
    }
});

