<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ options.label }}</label>
    <div class="col-sm-5">
      <div class="alert alert-secondary mb-0 h-100 text-break-all">
        <div v-if="blank(before)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="form-text">{{ before }}</div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="alert alert-success mb-0 h-100 text-break-all">
        <div v-if="blank(after)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="form-text">{{ after }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LogSelection",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
    }
  },
  computed: {
    options: function () {
      return this.configs.options;
    },
    before: function () {
      let value = this.blank(this.value) ? null : this.array_get(this.value, 'before');
      value = (value === true) ? 1 : (value === false) ? 0 : value;
      let label = this.blank(value) ? null : this.array_get(this.options, 'options.' + value);
      return this.blank(label) ? value : label;
    },
    after: function () {
      let value = this.blank(this.value) ? null : this.array_get(this.value, 'after');
      value = (value === true) ? 1 : (value === false) ? 0 : value;
      let label = this.blank(value) ? null : this.array_get(this.options, 'options.' + value);
      return this.blank(label) ? value : label;
    }
  }
}
</script>
