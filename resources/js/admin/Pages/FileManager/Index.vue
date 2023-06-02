<template>
  <admin-layout :urls="urls" :configs="configs" :trans="trans" :breadcrumbs="breadcrumbs" v-slot:default="slotProps" v-on:page-min-height-change="getAreaHeight()">
    <section class="panel panel-default" id="file-manager-panel" v-bind:style="{minHeight: slotProps.pageMinHeight + 'px'}">
      <header class="panel-heading">
        <h1 class="h5 float-left font-weight-bold">{{ array_get(trans, 'title') }}</h1>
        <a class="btn btn-sm rounded-pill btn-secondary ml-2"
           v-if="filled(urls.guide)"
           :href="urls.guide" target="_blank" :title="array_get(trans, 'ui.button.guide')">
          <i class="icon-help"></i>
        </a>
      </header>

      <div class="panel-wrapper">
        <div class="panel-body pt-0 pl-0 pr-0 pb-0" v-bind:style="{height: fmHeight + 'px'}">
          <file-manager v-bind:settings="settings"></file-manager>
        </div>
      </div>
    </section>
  </admin-layout>
</template>

<script>
import AdminLayout from "../../Components/Layout/SiteMain";
import en from 'laravel-file-manager/src/lang/en';
import zh_CN from 'laravel-file-manager/src/lang/zh_CN';
import zh_TW from 'laravel-file-manager/src/lang/zh_TW';

export default {
  name: "FileManagerIndex",
  components: {AdminLayout},
  props: {
    urls: Object,
    configs: Object
  },
  data() {
    return {
      breadcrumbs: [],
      trans: {},
      fmMinHeight: 500,
      fmHeight: 500
    }
  },
  created() {
    this.getUI();
  },
  mounted() {
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
    getUI: function () {
      axios
        .get(this.urls.api_ui)
        .then((response) => {
          this.breadcrumbs = response.data.data.breadcrumbs;
          this.trans = response.data.data.trans;
          this.columns = response.data.data.columns;
          this.search = response.data.data.searches;
          this.options = response.data.data.options;
          this.$nextTick(function () {
            window.dispatchEvent(new Event('resize'));
          });
        });
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
    getAreaHeight: function () {
      if (document.getElementById('file-manager-panel')
        && document.querySelector('#file-manager-panel > .panel-heading')) {
        this.$nextTick(() => {
          let calcHeight = document.getElementById('file-manager-panel').offsetHeight
            - document.querySelector('#file-manager-panel > .panel-heading').offsetHeight;
          if (calcHeight > this.fmMinHeight) {
            this.fmHeight = calcHeight;
          }
        });
      }
    }
  }
}
</script>
