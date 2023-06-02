<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ options.label }}</label>
    <div class="col-sm-5">
      <div class="alert alert-secondary mb-0 h-100 text-break-all">
        <div v-if="blank(before)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="form-text">{{ transform(before) }}</div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="alert alert-success mb-0 h-100 text-break-all">
        <div v-if="blank(after)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="form-text">{{ transform(after) }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LogOrigin",
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
      return this.blank(this.value) ? null : this.array_get(this.value, 'before');
    },
    after: function () {
      return this.blank(this.value) ? null : this.array_get(this.value, 'after');
    }
  },
  methods: {
    transform: function (content) {
      if (this.blank(content)) {
        return null;
      }

      if (typeof content === "boolean") {
        return content ? 'true' : 'false';
      }

      if (Array.isArray(content) || typeof content === "object") {
        return JSON.stringify(content);
      }

      return content;
    }
  }
}
</script>
