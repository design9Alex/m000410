<template>
  <div class="d-inline-block">
    <a
      v-if="filled(url)"
      href="#"
      :class="valueClasses"
      @click="doSwitch($event)">{{ valueText }}</a>
    <span
      v-else
      :class="valueClasses">{{ valueText }}</span>
  </div>
</template>

<script>
export default {
  name: "Switcher",
  props: {
    trans: Object,
    value: Object,
    configs: Object
  },
  data() {
    return {
      defaultOptions: {
        attribute: 'label',
        options: [],
        emptyText: null
      }
    }
  },
  computed: {
    options: function () {
      if (this.blank(this.configs)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs}
    },
    valueText: function () {
      let value = this.array_get(this.value, 'value');
      let options = this.array_get(this.options, 'options');

      if (this.filled(value) && this.filled(options)) {
        if (typeof value === "boolean") {
          value = value ? 1 : 0;
        }

        for (let index in options) {
          let optionValue = this.array_get(options[index], 'value');
          if (this.filled(optionValue) && (optionValue + '') === (value + '')) {
            return this.array_get(options[index], this.options.attribute);
          }
        }
      }

      return this.options.emptyText;
    },
    valueClasses: function () {
      let value = this.array_get(this.value, 'value');
      let options = this.array_get(this.options, 'options');
      let classes = [];

      if (this.filled(value) && this.filled(options)) {
        if (typeof value === "boolean") {
          value = value ? 1 : 0;
        }

        for (let index in options) {
          let optionValue = this.array_get(options[index], 'value');
          if (this.filled(optionValue) && (optionValue + '') === (value + '')) {
            let optionClass = this.array_get(options[index], 'options.class');
            if (this.filled(optionClass)) {
              classes.push(...optionClass.split(' '));
            }
            break;
          }
        }
      }

      if (this.filled(classes)) {
        return classes.concat(['badge', 'badge-pill']);
      }

      return [];
    },
    originalValue: function () {
      if (this.blank(this.value)) {
        return null;
      } else if (typeof this.value === 'boolean') {
        return this.value ? 1 : 0;
      } else {
        if (this.value.hasOwnProperty('value')) {
          let value = this.value.value;
          if (typeof value === 'boolean') {
            return value ? 1 : 0;
          } else {
            return parseInt(value)
          }
        }
        return null;
      }
    },
    url: function () {
      return this.array_get(this.value, 'url');
    }
  },
  methods: {
    doSwitch: function ($event) {
      $event.preventDefault();

      if (this.filled(this.url)) {
        this.$swal({
          title: this.array_get(this.trans, 'ui.message.updating'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .put(this.url, {column: this.options.key, value: !this.originalValue})
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('changed');
              setTimeout(() => {this.$swal.close()}, 300);
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      }
    }
  }
}
</script>
