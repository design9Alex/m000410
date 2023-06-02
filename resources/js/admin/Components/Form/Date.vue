<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <date-picker input-class="form-control"
                   type="date"
                   format="YYYY-MM-DD"
                   value-type="format"
                   :lang="uiLang"
                   :placeholder="options.placeholder"
                   :value="value"
                   :input-attr="{required: options.required}"
                   v-on:input="$emit('input', $event)"
                   v-on:change="$emit('input', $event)" />
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';

export default {
  name: "Date",
  components: {
    DatePicker
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 3,
        placeholder: null,
        required: false,
        hint: null
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
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label;
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
    },
    uiLang: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return 'zh-tw';
        case 'zh-CN':
          return 'zh-cn';
        case 'ja':
          return 'ja';
        default:
          return 'en';
      }
    }
  }
}
</script>
