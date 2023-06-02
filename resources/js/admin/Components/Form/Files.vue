<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <button class="btn btn-secondary" type="button" @click="fileManagerShow = true">
        <i class="icon-folder"></i> {{ array_get(trans, 'ui.button.file') }}
      </button>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
    <div v-if="filled(currentValue)" class="ml-sm-auto col-sm-10 mt-3 file-img-list"
         @dragover="moving"
         @drop="moveReceived">
      <div v-for="(file, index) in currentValue" class="alert alert-info alert-dismissible fade show" role="alert"
           draggable="true"
           @dragstart="moveStart($event, index)">
        {{ file.path }}
        <a class="alert-link" target="_blank" :href="asset(file.path)">
          <i class="icon-popout"></i>
        </a>
        <button type="button" class="close delBtn" aria-label="Close" @click="removeFile(index)">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    </div>
    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog"
         v-if="fileManagerShow"
         @click="hideFileManager($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ array_get(trans, 'ui.topic.file_picker') }}
              <small class="text-muted ml-3">{{ array_get(trans, 'ui.topic.file_hint') }}</small>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="fileManagerShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0 pl-0 pr-0 pb-0" v-bind:style="{height: modalHeight() + 'px'}">
            <file-manager v-bind:settings="settings"></file-manager>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="fileManagerShow"></div>
  </div>
</template>

<script>
import en from 'laravel-file-manager/src/lang/en';
import zh_CN from 'laravel-file-manager/src/lang/zh_CN';
import zh_TW from 'laravel-file-manager/src/lang/zh_TW';

export default {
  name: "Files",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        limit: null,
        required: false,
        hint: null
      },
      defaultValue: {
        path: null
      },
      dialog: {
        init: null,
        mySubmit: null
      },
      currentDetail: null,
      currentPreview: null,
      fileManagerShow: false
    }
  },
  mounted() {
    this.dialog.init = this.dialogInit;
    this.dialog.mySubmit = this.dialogMySubmit;
  },
  watch: {
    fileManagerShow: function (status) {
      if (status) {
        this.$store.commit('fm/setFileCallBack', (fileUrl) => {
          this.dialog.mySubmit(fileUrl);
        });
        document.body.classList.add("modal-open");
      } else {
        document.body.classList.remove("modal-open");
      }
    },
    currentDetail: function (value) {
      if (value === null) {
        document.body.classList.remove("modal-open");
      } else {
        document.body.classList.add("modal-open");
      }
    }
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs.options}
    },
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value.map((pic) => {
          return {...this.defaultValue, ...pic};
        });
      },
      set: function (value) {
        this.$emit('input', value);
      }
    },
    settings: function () {
      return {
        baseUrl: this.configs.fm_base,
        lang: this.getLanguage(),
        translation: this.getTranslation()
      };
    },
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.' + this.configs.key);
      }
      return null;
    },
    hint: function () {
      if (this.filled(this.options.hint)) {
        if (this.options.hint === false) {
          return null;
        }
        return this.options.hint;
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.hints.' + this.configs.key);
      }
      return null;
    }
  },
  methods: {
    initValue: function (value) {
      if (typeof value === 'boolean') {
        return value ? 1 : 0;
      }
      return value;
    },
    modalHeight: function () {
      if (window) {
        return window.innerHeight * 0.80 - 60;
      }
      return 0;
    },
    getLanguage: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return 'zh-TW';
        case 'zh-CN':
          return 'zh-CN';
        default:
          return 'en-US';
      }
    },
    getTranslation: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return {name: 'zh-TW', content: zh_TW};
        case 'zh-CN':
          return {name: 'zh-CN', content: zh_CN};
        default:
          return {name: 'en-US', content: en};
      }
    },
    dialogInit: function () {
    },
    dialogMySubmit: function (URL) {
      // pass selected file path back
      this.pushFile('/' + URL.split('/').slice(this.configs.root.split('/').length).join('/'));
    },
    hideFileManager: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.fileManagerShow = false;
      }
    },
    asset: function (path) {
      if (this.blank(path)) {
        return null;
      }

      if (this.blank(this.configs.root)) {
        return path;
      }

      if (/^http/.test(path)) {
        return path;
      }

      return this.configs.root.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
    },
    moveStart: function ($event, index) {
      $event.dataTransfer.setData("text/plain", index);
      $event.dropEffect = "move";
    },
    moving: function ($event) {
      $event.preventDefault();
      $event.dataTransfer.dropEffect = "move";
    },
    moveReceived: function ($event) {
      $event.preventDefault();
      let index = parseInt($event.dataTransfer.getData("text"));
      let target = $event.target.closest('.file-img-list > .card');
      let targetIndex = this.blank(target)
        ? this.currentValue.length - 1
        : Array.from(target.parentNode.children).indexOf(target);
      this.sortFile(index, targetIndex);
    },
    sortFile: function (sourceIndex, targetIndex) {
      if (sourceIndex === targetIndex) {
        return;
      }

      let sorted = [];
      for (let index in this.currentValue) {
        if (!this.currentValue.hasOwnProperty(index)) continue;

        if (parseInt(index) === sourceIndex) continue;

        if (sourceIndex < targetIndex) {
          sorted.push(this.currentValue[index]);
        }

        if (parseInt(index) === targetIndex) {
          sorted.push(this.currentValue[sourceIndex]);
        }

        if (sourceIndex > targetIndex) {
          sorted.push(this.currentValue[index]);
        }
      }

      this.currentValue = sorted;
    },
    pushFile: function (url) {
      let currentValue = this.currentValue;
      if (this.filled(this.options.limit) && currentValue.length + 1 > this.options.limit) {
        this.fileManagerShow = false;
        this.$swal({
          text: this.array_get(this.trans, 'ui.message.file_limit'),
          icon: "warning"
        });
        return;
      }

      currentValue.push({...this.defaultValue, ...{path: url}});
      this.currentValue = currentValue;

      if (this.filled(this.options.limit) && currentValue.length >= this.options.limit) {
        this.fileManagerShow = false;
      }
    },
    removeFile: function (index) {
      let value = this.currentValue;
      value.splice(index, 1);
      this.currentValue = value;
    }
  }
}
</script>
