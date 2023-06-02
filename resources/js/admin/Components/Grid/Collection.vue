<template>
  <div class="d-inline-block" v-if="options.badge">
    <span
      v-for="itemValue in value"
      :class="getClasses(itemValue)">
      {{ getText(itemValue) }}
    </span>
  </div>
  <span v-else>
    <template v-for="(itemValue, index) in value">
      <template v-if="index === 0">
        {{ getText(itemValue) }}
      </template>
      <template v-else>
        {{ options.delimiter }}{{ getText(itemValue) }}
      </template>
    </template>
  </span>
</template>

<script>
export default {
  name: "Collection",
  props: {
    trans: Object,
    value: Array,
    configs: Object
  },
  data() {
    return {
      defaultOptions: {
        badge: false,
        attribute: 'label',
        delimiter: ', ',
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
    }
  },
  methods: {
    getText: function (value) {
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
    getClasses: function (value) {
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
