<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ options.label }}</label>
    <div class="col-sm-5">
      <div class="alert alert-secondary mb-0 h-100">
        <div v-if="blank(before)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <tiny-mce-editor
          v-else
          type="text" class="form-control"
          :id="configs.key.replaceAll('.', '-') + '_before'"
          :key="configs.key.replaceAll('.', '-') + '_before'"
          :init="initConfiguration"
          v-model="before" />
      </div>
    </div>
    <div class="col-sm-5">
      <div class="alert alert-success mb-0 h-100">
        <div v-if="blank(after)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <tiny-mce-editor
          v-else
          type="text" class="form-control"
          :id="configs.key.replaceAll('.', '-') + '_after'"
          :key="configs.key.replaceAll('.', '-') + '_after'"
          :init="initConfiguration"
          v-model="after" />
      </div>
    </div>
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
  name: "LogEditor",
  components: {
    TinyMceEditor
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      initConfiguration: {
        base_url: '/static/admin/modules/tinymce',
        readonly: 1,
        plugins: ['code', 'fullscreen', 'noneditable', 'preview'],
        toolbar: '',
        menubar: 'view',
        importcss_append: true,
        image_advtab: true,
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
      return this.configs.options;
    },
    before: function () {
      return this.blank(this.value) ? '' : this.array_get(this.value, 'before');
    },
    after: function () {
      return this.blank(this.value) ? '' : this.array_get(this.value, 'after');
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
