<template>
  <a v-if="filled(url)" :class="options.class" :href="url">{{ text }}</a>
  <span v-else :class="options.class">{{ text }}</span>
</template>

<script>
export default {
  name: "Link",
  props: {
    trans: Object,
    value: [Object, String],
    configs: Object
  },
  data() {
    return {
      defaultConfigs: {
        class: []
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
      if (this.blank(this.value)) {
        return null;
      } else if (typeof this.value !== 'object') {
        return this.value.toString();
      } else {
        return this.value.hasOwnProperty('text') ? parseInt(this.value.text) : null;
      }
    },
    url: function () {
      if (this.blank(this.value) || typeof this.value !== 'object') {
        return null;
      } else {
        return this.value.hasOwnProperty('url') ? this.value.url : null;
      }
    }
  }
}
</script>
