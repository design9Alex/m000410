<template>
  <div class="text-nowrap">
    <template v-for="action in allActions">
      <a
        v-if="action.el === 'a'"
        class="btn btn-outline-default btn-sm" role="button" aria-pressed="true"
        :title="array_get(trans, 'ui.button.' + action.key)"
        :target="action.target"
        :href="array_get(value, action.key)">
        <i :class="action.icon"></i><span :class="action.showText === true ? 'ml-1' : 'text-hide'">{{ array_get(trans, 'ui.button.' + action.key) }}</span>
      </a>
      <button
        v-else-if="action.el === 'button'"
        :title="array_get(trans, 'ui.button.' + action.key)"
        class="btn btn-outline-default btn-sm"
        @click="doClick(action.method, array_get(value, action.key))">
        <i :class="action.icon"></i><span :class="action.showText === true ? 'ml-1' : 'text-hide'">{{ array_get(trans, 'ui.button.' + action.key) }}</span>
      </button>
    </template>
  </div>
</template>

<script>
export default {
  name: "GridActions",
  props: {
    trans: Object,
    value: Object,
    configs: Object
  },
  data() {
    return {
      defaultOptions: {
        actions: [],
        methods: {},
        showText: false
      },
      commonActions: {
        show: {el: 'a', icon: 'icon-eye3', target: '_self'},
        edit: {el: 'a', icon: 'icon-pencil', target: '_self'},
        log: {el: 'a', icon: 'icon-book-alt2', target: '_blank'},
        trash: {el: 'button', icon: 'icon-trash', method: 'doTrash'},
        destroy: {el: 'button', icon: 'icon-trash', method: 'doDestroy'},
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
    allActions: function () {
      let actions = [];

      if (this.blank(this.options.actions)) {
        for (let name in this.commonActions) {
          if (this.filled(this.array_get(this.value, name))) {
            actions.push({...{key: name}, ...this.commonActions[name]});
          }
        }
        return actions;
      }

      for (let index in this.options.actions) {
        let action = this.options.actions[index];
        if (typeof action === "string" && this.commonActions.hasOwnProperty(action)) {
          if (this.filled(this.array_get(this.value, action))) {
            actions.push({...{key: action}, ...this.commonActions[action]});
          }
        } else if (typeof action === "object" && this.filled(action)) {
          if (this.filled(this.array_get(this.value, action.key))) {
            actions.push(action);
          }
        }
      }

      return actions;
    }
  },
  methods: {
    doClick: function (method, url) {
      if (this.blank(method) || this.blank(url)) {
        return;
      }

      switch (method) {
        case 'doTrash':
          this.doTrash(url);
          break;
        case 'doDestroy':
          this.doDestroy(url);
          break;
        default:
          if (this.options.methods.hasOwnProperty(method)) {
            this.options.methods[method](url);
          }
          break;
      }
    },
    doTrash: function (url) {
      if (this.blank(url)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.trash_alert_title'),
        text: this.array_get(this.trans, 'ui.message.trash_alert_message'),
        icon: 'warning',
        customClass: {
          confirmButton: 'btn btn-danger ml-2',
          cancelButton: 'btn btn-outline-default mr-2',
        },
        showConfirmButton: true,
        confirmButtonText: this.array_get(this.trans, 'ui.button.admit'),
        showCancelButton: true,
        cancelButtonText: this.array_get(this.trans, 'ui.button.cancel'),
        buttonsStyling: false,
        reverseButtons: true,
        focusCancel: true
      }).then((result) => {
        if (!result.isConfirmed) {
          return;
        }

        this.$swal({
          title: this.array_get(this.trans, 'ui.message.destroying'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .delete(url)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('changed');
              this.$swal.close();
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      });
    },
    doDestroy: function (url) {
      if (this.blank(url)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.destroy_alert_title'),
        text: this.array_get(this.trans, 'ui.message.destroy_alert_message'),
        icon: 'warning',
        customClass: {
          confirmButton: 'btn btn-danger ml-2',
          cancelButton: 'btn btn-outline-default mr-2',
        },
        showConfirmButton: true,
        confirmButtonText: this.array_get(this.trans, 'ui.button.admit'),
        showCancelButton: true,
        cancelButtonText: this.array_get(this.trans, 'ui.button.cancel'),
        buttonsStyling: false,
        reverseButtons: true,
        focusCancel: true
      }).then((result) => {
        if (!result.isConfirmed) {
          return;
        }

        this.$swal({
          title: this.array_get(this.trans, 'ui.message.destroying'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .delete(url)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('changed');
              this.$swal.close();
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      });
    }
  }
}
</script>
