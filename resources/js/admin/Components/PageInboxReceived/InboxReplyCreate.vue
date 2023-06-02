<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <h1 class="h5 float-left font-weight-bold">{{ array_get(trans, 'ui.topic.inbox_reply') }}</h1>
    </header>
    <div class="panel-wrapper">
      <div class="panel-body">

        <template v-for="column in columns">

          <minmax-input-text
            v-if="str_is('bcc', column.key)"
            :trans="trans"
            :configs="{
              key: column.key, language: column.language
            }"
            v-model="liveValues[column.key]" />

          <minmax-editor
            v-else-if="str_is('content', column.key)"
            :trans="trans"
            :configs="{
            key: column.key, language: column.language,
            api_fm: urls.api_fm, api_template: urls.api_template,
              options: {required: true, height: '500px'}
            }"
            v-model="liveValues[column.key]" />

          <minmax-radio
            v-else-if="str_is('visible', column.key)"
            :trans="trans"
            :configs="{
            key: column.key, language: column.language,
              options: {required: true, options: getOptions(column.key, options)}
            }"
            v-model="liveValues[column.key]" />

          <minmax-radio
            v-else-if="str_is('notify', column.key)"
            :trans="trans"
            :configs="{
            key: column.key, language: column.language,
              options: {required: true, options: getOptions(column.key, options)}
            }"
            v-model="liveValues[column.key]" />

          <minmax-radio
            v-else-if="str_is('complete', column.key) && modifiable"
            :trans="trans"
            :configs="{
            key: column.key, language: column.language,
              options: {required: true, options: getOptions(column.key, options)}
            }"
            v-model="liveValues[column.key]" />

        </template>

        <div class="text-center my-4 form-btn-group">
          <button class="btn btn-main"
                  type="button"
                  :disabled="sending"
                  @click="submitForm(trans)">
            {{ array_get(trans, 'ui.button.submit') }}</button>
          <button class="btn btn-default"
                  type="button"
                  :disabled="sending"
                  @click="getData">
            {{ array_get(trans, 'ui.button.reset') }}</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import MinmaxEditor from '../Form/Editor';
import MinmaxInputText from '../Form/InputText';
import MinmaxRadio from '../Form/Radio';

export default {
  name: "InboxReplyCreate",
  props: {
    "urls": Object,
    "modifiable": {
      type: Boolean,
      default: true
    }
  },
  components: {
    MinmaxEditor,
    MinmaxInputText,
    MinmaxRadio
  },
  data() {
    return {
      trans: {},
      columns: [],
      options: [],
      liveValues: {},
      defaultValues: {},
      sending: false
    }
  },
  created() {
    this.getUI();
  },
  mounted() {
    this.getData();
  },
  methods: {
    getUI: function () {
      if (this.filled(this.urls.api_ui)) {
        axios
          .get(this.urls.api_ui)
          .then((response) => {
            this.updateUI(response.data.data.trans, response.data.data.columns, response.data.data.options);
          });
      }
    },
    updateUI: function (trans, columns, options) {
      this.trans = trans;
      this.columns = columns;
      this.options = options;
    },
    getData: function () {
      if (this.filled(this.urls.api_data)) {
        axios
          .get(this.urls.api_data)
          .then((response) => {
            if (this.filled(response.data.data)) {
              this.defaultValues = response.data.data;
            }
            this.liveValues = JSON.parse(JSON.stringify(this.defaultValues));
          });
      }
    },
    getOptions: function (column, optionSet) {
      return this.array_get(optionSet, column + '.options', []);
    },
    submitForm: function (trans) {
      if (this.filled(this.urls.store) && this.filled(this.liveValues)) {
        this.sending = true;
        this.$swal({
          title: this.array_get(this.trans, 'ui.message.replying'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });
        axios
          .post(this.urls.store, this.liveValues)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: response.data.message, icon: 'success', timer: 2000})
                .then(() => {
                  this.sending = false;
                  this.getData();
                  this.$emit('replyCreated');
                });
            }
          })
          .catch((error) => {
            this.sending = false;
            for (let column in error.response.data.errors) {
              if (error.response.data.errors.hasOwnProperty(column)) {
                this.$swal({text: error.response.data.errors[column][0], icon: 'error'});
                break;
              }
            }
          });
      } else {
        this.$swal({text: this.array_get(trans, 'ui.message.no_attribute'), icon: 'warning'});
      }
    }
  }
}
</script>
