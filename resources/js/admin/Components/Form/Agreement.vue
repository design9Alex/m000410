<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <div class="offset-sm-2" :class="['col-sm-' + options.size]">
      <div class="custom-control custom-checkbox custom-control-inline">
        <input class="custom-control-input" type="checkbox"
               :id="configs.key.replaceAll('.', '-')"
               :disabled="options.disabled === true"
               v-model="currentValue" />
        <label v-if="filled(label)"
               class="custom-control-label"
               :for="configs.key.replaceAll('.', '-')">
          <span class="text-danger mr-1" v-if="options.required">*</span>{{ label }}
        </label>
      </div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Agreement",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        label: null,
        size: 10,
        required: false,
        hint: null,
        disabled: false
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
        return this.blank(this.value) ? false : (this.value === true || this.value === 1);
      },
      set: function (value) {
        this.$emit('input', this.blank(value) ? false : (value === true || value === 1));
      }
    },
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label
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
  }
}
</script>
