<template>
  <span :class="options.class">{{ text }}</span>
</template>

<script>
export default {
  name: "Plaintext",
  props: {
    trans: Object,
    value: [String, Boolean, Number],
    configs: Object
  },
  data() {
    return {
      defaultConfigs: {
        class: [],
        emptyText: null
      }
    }
  },
  computed: {
    options: function () {
      if (this.blank(this.configs)) {
        return this.defaultConfigs;
      }
      return {...this.defaultConfigs, ...this.configs}
    },
    text: function () {
      return this.blank(this.value) ? this.options.emptyText : this.value;
    }
  }
}
</script>
