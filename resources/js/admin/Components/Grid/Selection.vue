<template>
  <div class="d-inline-block" v-if="options.badge && filled(valueClasses)">
    <span :class="valueClasses">{{ valueText }}</span>
  </div>
  <span v-else>{{ valueText }}</span>
</template>

<script>
export default {
  name: "Selection",
  props: {
    trans: Object,
    value: [Boolean, String, Number],
    configs: Object
  },
  data() {
    return {
      defaultOptions: {
        badge: false,
        attribute: 'label',
        options: [],
        emptyText: null
      }
    }
  },
  computed: {
    options: function () {
      if (this.blank(this.configs)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs}
    },
    valueText: function () {
      let value = this.value;
      let options = this.array_get(this.options, 'options');

      if (this.filled(value) && this.filled(options)) {
        if (typeof value === "boolean") {
          value = value ? 1 : 0;
        }

        for (let index in options) {
          let optionValue = this.array_get(options[index], 'value');
          if (this.filled(optionValue) && (optionValue + '') === (value + '')) {
            return this.array_get(options[index], this.options.attribute);
          }
        }
      }

      return this.options.emptyText;
    },
    valueClasses: function () {
      let value = this.value;
      let options = this.array_get(this.options, 'options');
      let classes = [];

      if (this.filled(value) && this.filled(options)) {
        if (typeof value === "boolean") {
          value = value ? 1 : 0;
        }

        for (let index in options) {
          let optionValue = this.array_get(options[index], 'value');
          if (this.filled(optionValue) && (optionValue + '') === (value + '')) {
            let optionClass = this.array_get(options[index], 'options.class');
            if (this.filled(optionClass)) {
              classes.push(...optionClass.split(' '));
            }
            break;
          }
        }
      }

      if (this.filled(classes)) {
        return classes.concat(['badge', 'badge-pill']);
      }

      return [];
    }
  }
}
</script>
