<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div class="custom-control custom-radio custom-control-inline mt-2"
           v-for="(option, index) in options.options">
        <input class="custom-control-input" type="radio"
               :id="configs.key.replaceAll('.', '-') + '-' + index"
               :disabled="option.disabled === true"
               :value="initValue(option.value)"
               v-model="currentValue" />
        <label class="custom-control-label"
               :for="configs.key.replaceAll('.', '-') + '-' + index">{{ option.label }}</label>
      </div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Radio",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        options: [],
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
    currentValue: {
      get: function () {
        return this.initValue(this.value);
      },
      set: function (value) {
        this.$emit('input', value);
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
    initValue: function (value) {
      if (typeof value === 'boolean') {
        return value ? 1 : 0;
      }
      return value;
    }
  }
}
</script>
