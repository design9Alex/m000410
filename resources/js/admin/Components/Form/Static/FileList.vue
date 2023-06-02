<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div v-if="blank(currentValue) || filled(hint)" :class="['col-sm-' + options.size]">
      <div v-if="blank(currentValue)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_list') }}
      </div>
      <small v-if="filled(hint)" class="form-text text-muted">
        <span v-html="hint"></span>
      </small>
    </div>
    <div v-if="filled(currentValue)" class="ml-sm-auto col-sm-10 file-img-list" :class="{'mt-3': filled(hint)}">
      <div v-for="file in currentValue" class="alert alert-info alert-dismissible fade show" role="alert">
        {{ file.path }}
        <a class="alert-link" target="_blank" :href="asset(file.path)">
          <i class="icon-popout"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FileList",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        required: false,
        hint: null
      },
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
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs.options}
    },
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value.map((pic) => {
          return {...this.defaultValue, ...pic};
        });
      },
      set: function (value) {
        this.$emit('input', value);
      }
    },
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.' + this.configs.key);
      }
      return null;
    },
    hint: function () {
      if (this.filled(this.options.hint)) {
        if (this.options.hint === false) {
          return null;
        }
        return this.options.hint;
      } else if (this.filled(this.trans)) {
        return this.array_get(this.trans, 'module.hints.' + this.configs.key);
      }
      return null;
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
