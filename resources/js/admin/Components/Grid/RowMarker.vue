<template>
  <div class="custom-control custom-checkbox checkboxes">
    <input class="custom-control-input" type="checkbox"
           :id="value"
           :value="value"
           :checked="status"
           @change="$emit('click', $event)">
    <label class="custom-control-label" :for="value"></label>
  </div>
</template>

<script>
export default {
  name: "RowMarker",
  props: {
    value: [String, Number],
    status: Boolean
  }
}
</script>
