<template>
  <div class="custom-control custom-checkbox">
    <input class="custom-control-input" type="checkbox" value="1" id="select-all"
           :aria-label="array_get(trans, 'ui.grid.select_all')"
           :checked="status"
           @click="$emit('click', $event)">
    <label class="custom-control-label" for="select-all"></label>
  </div>
</template>

<script>
export default {
  name: "AllMarker",
  props: {
    trans: Object,
    status: Boolean
  }
}
</script>
