<template>
  <div v-if="filled(url)" class="text-nowrap table-sort">
    <a class="btn btn-link text-body icon-arrow-long-up p-0 m-0" aria-pressed="true"
       @click="updateSort($event, '-')"></a>
    <input class="form-control form-control-sm text-center d-inline-block mr-0" type="text"
           v-model="currentValue"
           @keyup="doSort($event)" />
    <a class="btn btn-link text-body icon-arrow-long-down p-0 m-0" aria-pressed="true"
       @click="updateSort($event, '+')"></a>
  </div>
  <span v-else class="text-center">{{ currentValue }}</span>
</template>

<script>
export default {
  name: "Sorter",
  props: {
    trans: Object,
    value: [Object, String],
    configs: Object
  },
  data() {
    return {
      currentValue: null,
      url: null,
    }
  },
  watch: {
    value: {
      handler: function (afterVal) {
        this.$nextTick(() => this.initValue(afterVal));
      },
      deep: true,
      immediate: true
    }
  },
  computed: {
    originalValue: function () {
      if (this.blank(this.value)) {
        return null;
      } else if (typeof this.value === 'string' || typeof this.value === 'number') {
        return parseInt(this.value);
      } else {
        return this.value.hasOwnProperty('value') ? parseInt(this.value.value) : null;
      }
    }
  },
  methods: {
    initValue: function (value) {
      if (this.blank(value)) {
        this.currentValue = null;
        this.url = null;
      } else if (typeof value === 'string' || typeof value === 'number') {
        this.currentValue = parseInt(value);
        this.url = null;
      } else {
        this.currentValue = value.hasOwnProperty('value') ? parseInt(value.value) : null;
        this.url = value.hasOwnProperty('url') ? value.url : null;
      }
    },
    updateSort: function ($event, compute) {
      let $input = null;
      switch (compute) {
        case '+':
          $input = $event.target.previousElementSibling;
          this.currentValue += 1;
          break;
        case '-':
          $input = $event.target.nextElementSibling;
          this.currentValue -= 1;
          break;
      }

      if (typeof $input !== 'undefined' && $input !== null) {
        $input.dispatchEvent(new KeyboardEvent('keyup', {keyCode: 13}));
      }
    },
    doSort: function ($event) {
      $event.preventDefault();

      if ($event.type !== 'keyup' || $event.keyCode !== 13) {
        return;
      }

      if (this.currentValue < 1) {
        this.initValue(this.value);
        return;
      }

      if (parseInt(this.currentValue) === this.originalValue) {
        return;
      }

      if (this.filled(this.url)) {
        this.$swal({
          title: this.array_get(this.trans, 'ui.message.sorting'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .put(this.url, {value: this.currentValue})
          .then((response) => {
            if (response.data.code === '0000') {
              this.currentValue = response.data.data;
              this.$emit('changed');
              setTimeout(() => {this.$swal.close()}, 300);
            } else {
              this.initValue(this.value);
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.initValue(this.value);
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      }
    }
  }
}
</script>
