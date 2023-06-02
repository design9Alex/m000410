<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <tiny-mce-editor type="text" class="form-control"
                       :id="configs.key.replaceAll('.', '-')"
                       :key="configs.key.replaceAll('.', '-')"
                       :init="initConfiguration"
                       v-model="currentValue" />
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
import 'tinymce/tinymce';
import 'tinymce/themes/silver';
import 'tinymce/icons/default/icons';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/code';
import 'tinymce/plugins/directionality';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/hr';
import 'tinymce/plugins/image';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/media';
import 'tinymce/plugins/nonbreaking';
import 'tinymce/plugins/noneditable';
import 'tinymce/plugins/pagebreak';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/template';
import 'tinymce/plugins/textpattern';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/visualchars';
import TinyMceEditor from '@tinymce/tinymce-vue';

export default {
  name: "Editor",
  components: {
    TinyMceEditor
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        placeholder: null,
        required: false,
        hint: null
      },
      initConfiguration: {
        base_url: '/static/admin/modules/tinymce',
        plugins: [
          'preview', 'searchreplace', 'autolink', 'directionality', 'code',
          'visualblocks', 'visualchars', 'fullscreen', 'image', 'link',
          'media', 'template', 'table', 'charmap', 'hr',
          'pagebreak', 'nonbreaking', 'anchor', 'insertdatetime', 'lists',
          'textpattern', 'noneditable'
        ],
        toolbar: 'fontselect fontsizeselect'
          + ' | bold italic strikethrough underline forecolor backcolor'
          + ' | link image media'
          + ' | alignleft aligncenter alignright alignjustify'
          + ' | numlist bullist outdent indent'
          + ' | removeformat',
        menubar: 'edit insert format table view',
        importcss_append: true,
        image_advtab: true,
        image_dimensions: false,
        relative_urls: false,
        convert_urls: false,
        cleanup_on_startup: false,
        trim_span_elements: false,
        cleanup: false,
        verify_html: false,
        valid_children: '+a[div|h1|h2|h3|h4|h5|h6|p|ul|ol]',
        extended_valid_elements:"style,script[src],link[href|rel],i[id|class|style]",
        custom_elements:"style,~style,script,~script,link,~i",
        noneditable_noneditable_class: 'mceNonEditable',
        branding: false,
        font_formats: '微軟正黑=microsoft jhenghei'
          + '; 微軟雅黑=microsoft yahei'
          + '; 新細明體=times new roman,times,pmingliu'
          + '; 黑體=heiti tc,heiti sc; Arial=arial,helvetica,sans-serif'
          + '; Georgia=georgia,palatino; Helvetica=helvetica'
          + '; Tahoma=tahoma,arial,helvetica,sans-serif'
          + '; Verdana=verdana,geneva',
        fontsize_formats: '12px 14px 16px 18px 24px 36px 48px',
        height: '350px',
        content_css: [],
        templates: null,
        language: 'en',
        file_picker_callback: null
      }
    }
  },
  created() {
    this.setLanguage();
    this.setHeight();
    this.initConfiguration.templates = this.configs.api_template;
    if (this.configs.hasOwnProperty('editor_css')) {
      this.initConfiguration.content_css = this.configs.editor_css;
    }
    this.initConfiguration.file_picker_callback = this.filePicker;
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
        return this.value;
      },
      set: function (val) {
        this.$emit('input', val);
      }
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
    setLanguage: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          this.initConfiguration.language = 'zh_TW'; break;
        case 'zh-CN':
          this.initConfiguration.language = 'zh_CN'; break;
        case 'ja':
          this.initConfiguration.language = 'ja'; break;
      }
    },
    setHeight: function () {
      let height = this.options.height;
      if (this.filled(height)) {
        this.initConfiguration.height = height;
      }
    },
    filePicker: function (callback, value, meta) {
      let x = window.innerWidth || document.documentElement.clientWidth
        || document.getElementsByTagName('body')[0].clientWidth
      let y = window.innerHeight|| document.documentElement.clientHeight
        || document.getElementsByTagName('body')[0].clientHeight

      tinymce.activeEditor.windowManager.openUrl({
        url : this.configs.api_fm,
        title : this.array_get(this.trans, 'ui.topic.file_picker'),
        width : x * 0.8,
        height : y * 0.8,
        onMessage: (api, message) => {
          callback(message.content, { text: message.text })
        }
      })
    }
  }
}
</script>
