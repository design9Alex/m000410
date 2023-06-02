<template>
  <fieldset class="mt-4" v-if="filled(columns)">
    <legend class="legend h6 mb-4"><i class="icon-angle-double-down2 mr-2"></i>{{ label }}</legend>

    <div class="form-group row" v-if="filled(hint)">
      <div class="col">
        <div class="note note-info mb-0" v-html="hint"></div>
      </div>
    </div>

    <div class="form-group row" :class="{'len': configs.language}" v-for="column in columns">
      <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
        {{ getLabel(column.value) }}<span class="text-danger ml-1" v-if="isRequired(column.value)">*</span>
      </label>
      <div :class="['col-sm-' + options.size]">
        <input type="text" class="form-control" v-model="currentValue[column.key]" />
      </div>
    </div>
  </fieldset>
</template>

<script>
export default {
  name: "Parameters",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        placeholder: null,
        required: false,
        hint: null,
        columns: []
      },
      currentValue: {}
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
    columns: function () {
      let columns = this.options.columns;
      return this.blank(columns) ? [] : columns;
    }
  },
  watch: {
    value: {
      handler: function (afterVal) {
        this.currentValue = JSON.parse(JSON.stringify(afterVal));
      },
      deep: true,
      immediate: true
    },
    currentValue: {
      handler: function (afterVal) {
        if (JSON.stringify(afterVal) !== JSON.stringify(this.value)) {
          this.$emit('input', JSON.parse(JSON.stringify(afterVal)));
        }
      },
      deep: true
    },
    "options.columns": {
      handler: function (afterVal) {
        let value = {};

        if (this.filled(afterVal)) {
          for (let index in afterVal) {
            if (afterVal.hasOwnProperty(index)) {
              value[afterVal[index].key] = this.currentValue.hasOwnProperty(afterVal[index].key)
                ? this.currentValue[afterVal[index].key]
                : null;
            }
          }
        }

        this.currentValue = value;
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    getLabel: function (label) {
      if (this.blank(label)) {
        return '-';
      }

      if ((new RegExp(/\*$/)).test(label)) {
        return label.substring(0, label.length - 1);
      }

      return label;
    },
    isRequired: function (label) {
      if (this.blank(label)) {
        return false;
      }

      return (new RegExp(/\*$/)).test(label);
    }
  }
}
</script>
