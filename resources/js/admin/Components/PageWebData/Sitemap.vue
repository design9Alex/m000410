<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">{{ label }}</label>
    <div :class="['col-sm-' + options.size]">
      <textarea
        type="text" class="form-control"
        :id="configs.key.replaceAll('.', '-')"
        :rows="options.rows"
        :placeholder="options.placeholder"
        :required="options.required"
        :value="value"
        v-on:input="$emit('input', $event.target.value)"></textarea>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
    <div class="ml-sm-auto col-sm-10 mt-1">
      <button class="btn btn-sm btn-info" type="button" @click="generateSitemap">
        <i class="icon-cycle mr-2"></i>{{ array_get(trans, 'ui.button.sitemap_generate') }} {{ formatLastModified }}
      </button>
      <button class="btn btn-sm btn-warning" type="button" @click="submitSitemap">
        <i class="icon-exclamation-triangle mr-2"></i>{{ array_get(trans, 'ui.button.sitemap_submit') }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sitemap",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        placeholder: null,
        hint: null,
        rows: 5
      },
      lastModified: 0,
      watcher: null
    }
  },
  mounted() {
    this.lastModified = this.configs.lastModified;
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs.options}
    },
    label: function () {
      if (this.filled(this.options.label)) {
        return this.options.label;
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
    },
    formatLastModified: function () {
      if (this.lastModified <= 0) {
        return '';
      }

      let time = new Date(this.lastModified * 1000);
      return '(' + time.getFullYear()
        + '-' + (time.getMonth() + 1).toString().padStart(2, '0')
        + '-' + time.getDate().toString().padStart(2, '0')
        + ' ' + time.getHours().toString().padStart(2, '0')
        + ':' + time.getMinutes().toString().padStart(2, '0')
        + ':' + time.getSeconds().toString().padStart(2, '0') + ')';
    }
  },
  methods: {
    generateSitemap: function () {
      if (this.filled(this.configs.api_generator) && this.filled(this.configs.api_watcher)) {
        this.$swal({
          text: 'Generating...',
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios.get(this.configs.api_generator)
          .then((response) => {
            this.lastModified = response.data.data;

            clearInterval(this.watcher);
            this.watcher = setInterval(() => {
              axios.get(this.configs.api_watcher)
                .then((response) => {
                  if (response.data.data > this.lastModified) {
                    clearInterval(this.watcher);
                    this.$swal.close();
                    location.reload();
                  }
                });
            }, 2000);
          });
      }
    },
    submitSitemap: function () {
      if (this.filled(this.configs.api_submit)) {
        axios.get(this.configs.api_generator)
          .then(() => {
            this.$swal({
              text: 'Submitted!',
              icon: 'success',
              showConfirmButton: false,
              timer: 2000
            });
          });
      }
    }
  }
}
</script>
