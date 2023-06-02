<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <div v-if="blank(currentValue)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_data') }}
      </div>
      <div v-else class="form-text">{{ collection }}</div>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "Collection",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        options: [],
        group: false,
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
    currentValue: function () {
      return this.blank(this.value) ? [] : this.value;
    },
    collection: function () {
      if (this.blank(this.currentValue) || this.blank(this.options.options)) {
        return null;
      }

      let text = '';
      for (let j in this.currentValue) {
        let value = this.currentValue[j];
        if (typeof value === "boolean") {
          value = value ? '1' : '0';
        } else if (typeof value !== "string") {
          value = value + '';
        }
        for (let i in this.options.options) {
          if (this.options.group && this.filled(this.options.options[i].options)) {
            for (let z in this.options.options[i].options) {
              if ((this.options.options[i].options[z].value + '') === value) {
                text += (text === '' ? '' : ', ')
                  + (this.blank(this.options.options[i].options[z].name)
                    ? this.options.options[i].options[z].label
                    : this.options.options[i].options[z].name);
                break;
              }
            }
          } else {
            if ((this.options.options[i].value + '') === value) {
              text += (text === '' ? '' : ', ')
                + (this.blank(this.options.options[i].name)
                  ? this.options.options[i].label
                  : this.options.options[i].name);
              break;
            }
          }
        }
      }

      return text;
    }
  }
}
</script>
