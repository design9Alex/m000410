<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div v-if="blank(value)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_data') }}
      </div>
      <div v-else-if="options.badge" class="form-text"><span :class="valueClasses">{{ valueLabel }}</span></div>
      <div v-else class="form-text">{{ valueLabel }}</div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Selection",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        options: [],
        required: false,
        hint: null,
        badge: false,
        emptyText: null,
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
    },
    valueLabel: function () {
      let value = this.value;
      if (typeof value === "boolean") {
        value = value ? '1' : '0';
      } else if (typeof value !== "string") {
        value = value + '';
      }

      for (let index in this.options.options) {
        if ((this.options.options[index].value + '') === value) {
          return this.filled(this.options.options[index].name)
            ? this.options.options[index].name
            : this.options.options[index].label;
        }
      }
      return this.options.emptyText;
    },
    valueClasses: function () {
      let value = this.value;
      if (typeof value === "boolean") {
        value = value ? '1' : '0';
      } else if (typeof value !== "string") {
        value = value + '';
      }

      let classes = [];

      for (let index in this.options.options) {
        if ((this.options.options[index].value + '') === value) {
          let optionClass = this.array_get(this.options.options[index], 'options.class');
          if (this.filled(optionClass)) {
            classes.push(optionClass);
            break;
          }
        }
      }

      if (this.blank(classes)) {
        return [];
      }

      classes.push('badge');
      classes.push('badge-pill');

      return classes;
    }
  }
}
</script>
