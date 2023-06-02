<template>
  <span>
    <span
      v-for="i in value.length"
      class="badge badge-pill"
      :class="[i === value.current ? 'badge-main' : 'badge-secondary']">{{ i }}</span>
  </span>
</template>

<script>
export default {
  name: "Gates",
  props: {
    trans: Object,
    value: Object,
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
    }
  }
}
</script>
