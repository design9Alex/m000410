<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" id="fm-main-block">
        <file-manager v-bind:settings="settings"></file-manager>
      </div>
    </div>
  </div>
</template>

<script>
import en from 'laravel-file-manager/src/lang/en';
import zh_CN from 'laravel-file-manager/src/lang/zh_CN';
import zh_TW from 'laravel-file-manager/src/lang/zh_TW';

export default {
  name: "FileManagerTinyMce",
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      dialog: {
        init: null,
        mySubmit: null
      }
    }
  },
  mounted() {
    let _self = this;

    document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');

    _self.dialog.init = _self.dialogInit;
    _self.dialog.mySubmit = _self.dialogMySubmit;

    _self.$store.commit('fm/setFileCallBack', function(fileUrl) {
      _self.dialog.mySubmit(fileUrl);
    });
  },
  computed: {
    settings: function () {
      return {
        baseUrl: this.urls.fm_base,
        lang: this.getLanguage(),
        translation: this.getTranslation()
      };
    }
  },
  methods: {
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
      // pass selected file path to TinyMCE
      parent.postMessage({
        mceAction: 'insert',
        content: URL,
        text: URL.split('/').pop()
      })
      // close popup window
      parent.postMessage({
        mceAction: 'close'
      });
    }
  }
}
</script>
