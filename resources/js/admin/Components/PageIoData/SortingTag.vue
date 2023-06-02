<template>
  <button class="btn btn-light mb-2 mr-1 text-left" type="button" @click="$emit('click')">
    <i class="icon-cross mr-2 text-danger"></i><!--
    --><span class="text-muted">{{ column }}：</span><!--
    --><b class="text-dark">{{ direction }}</b>
  </button>
</template>

<script>
export default {
  name: "SortingTag",
  props: {
    "trans": Object,
    "sorting": Object,
    "options": {
      type: Object,
      default: function () {
        return {};
      }
    }
  },
  computed: {
    column: function () {
      if (this.filled(this.trans) && this.filled(this.sorting)) {
        return this.array_get(this.trans, 'module.' + this.sorting.column);
      }
      return null;
    },
    direction: function () {
      if (this.filled(this.trans) && this.filled(this.sorting)) {
        return this.array_get(this.trans, 'ui.filter.direction.' + this.sorting.direction);
      }
      return null;
    }
  }
}
</script>
