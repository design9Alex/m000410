<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ options.label }}</label>
    <div class="col-sm-5">
      <div v-if="blank(currentBefore)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_data') }}
      </div>
      <template v-else>
        <div v-for="file in currentBefore" class="alert alert-info" role="alert">{{ file.path }}</div>
      </template>
    </div>
    <div class="col-sm-5">
      <div v-if="blank(currentAfter)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_data') }}
      </div>
      <template v-else>
        <div v-for="file in currentAfter" class="alert alert-info" role="alert">{{ file.path }}</div>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  name: "LogFiles",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultValue: {
        path: null
      },
      currentDetail: null,
      currentPreview: null
    }
  },
  watch: {
    currentDetail: function (value) {
      if (value === null) {
        document.body.classList.remove("modal-open");
      } else {
        document.body.classList.add("modal-open");
      }
    }
  },
  computed: {
    options: function () {
      return this.configs.options;
    },
    currentBefore: function () {
      let files = this.blank(this.value) ? [] : this.array_get(this.value, 'before');

      return this.blank(files) ? [] : files.map((file) => {
        return {...this.defaultValue, ...file};
      });
    },
    currentAfter: function () {
      let files = this.blank(this.value) ? [] : this.array_get(this.value, 'after');

      return this.blank(files) ? [] : files.map((file) => {
        return {...this.defaultValue, ...file};
      });
    }
  },
  methods: {
    initValue: function (value) {
      if (typeof value === 'boolean') {
        return value ? 1 : 0;
      }
      return value;
    },
    asset: function (path) {
      if (this.blank(path)) {
        return null;
      }

      if (this.blank(this.configs.root)) {
        return path;
      }

      if (/^http/.test(path)) {
        return path;
      }

      return this.configs.root.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
    }
  }
}
</script>
