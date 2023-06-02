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
  name: "LogCollection",
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
      let values = this.blank(this.value) ? null : this.array_get(this.value, 'before');

      if (this.blank(values)) {
        return null;
      }

      let text = '';
      for (let index in values) {
        let value = (values[index] === true) ? 1 : (values[index] === false) ? 0 : values[index];
        let label = this.array_get(this.options, 'options.' + value);

        text += (this.blank(text) ? '' : ', ') + (this.blank(label) ? value : label);
      }

      return this.blank(text) ? null : text;
    },
    after: function () {
      let values = this.blank(this.value) ? null : this.array_get(this.value, 'after');

      if (this.blank(values)) {
        return null;
      }

      let text = '';
      for (let index in values) {
        let value = (values[index] === true) ? 1 : (values[index] === false) ? 0 : values[index];
        let label = this.array_get(this.options, 'options.' + value);

        text += (this.blank(text) ? '' : ', ') + (this.blank(label) ? value : label);
      }

      return this.blank(text) ? null : text;
    }
  }
}
</script>
