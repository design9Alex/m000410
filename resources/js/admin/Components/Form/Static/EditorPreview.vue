<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}"
           :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <tiny-mce-editor type="text" class="form-control"
                       :id="configs.key.replaceAll('.', '-')"
                       :key="configs.key.replaceAll('.', '-')"
                       :init="initConfiguration"
                       :disabled="true"
                       v-model="value" />
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
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/noneditable';
import 'tinymce/plugins/preview';
import TinyMceEditor from '@tinymce/tinymce-vue';

export default {
  name: "EditorPreview",
  components: {
    TinyMceEditor
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        required: false,
        hint: null
      },
      initConfiguration: {
        base_url: '/static/admin/modules/tinymce',
        plugins: ['code', 'fullscreen', 'noneditable', 'preview'],
        toolbar: '',
        menubar: 'view',
        importcss_append: true,
        image_advtab: true,
        image_dimensions: false,
        relative_urls: true,
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
        height: '350px',
        content_css: [],
        language: 'en'
      }
    }
  },
  created() {
    this.setLanguage();
    this.setHeight();
    if (this.configs.hasOwnProperty('editor_css')) {
      this.initConfiguration.content_css = this.configs.editor_css;
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
    }
  }
}
</script>
