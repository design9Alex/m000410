<template>
  <div class="btn-group btn-group-sm dropdown" role="group" v-show="batchable()">
    <button
      class="btn dropdown-toggle btn-main"
      type="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      :title="array_get(trans, 'ui.button.batch')">
      <i class="icon-hammer"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.batch') }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <button class="dropdown-item"
              v-if="available('destroy')"
              @click="doBatch('destroy', true)">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.destroy') }}
      </button>
      <button class="dropdown-item"
              v-if="available('trash')"
              @click="doBatch('trash', true)">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.trash') }}
      </button>
      <button class="dropdown-item"
              v-if="available('export')"
              @click="doBatch('export')">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.export') }}
      </button>
      <slot
        v-bind:available="available"
        v-bind:doBatch="doBatch"></slot>
      <button class="dropdown-item"
              v-if="available('active')"
              @click="doBatch('active')">
        <i class="icon-eye mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.active') }}
      </button>
      <button class="dropdown-item"
              v-if="available('inactive')"
              @click="doBatch('inactive')">
        <i class="icon-cancel mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.inactive') }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "SitePageBatch",
  props: {
    urls: Object,
    trans: Object,
    currentSelected: []
  },
  methods: {
    batchable: function () {
      if (typeof this.$el !== "undefined") {
        let dropdownMenu = this.$el.getElementsByClassName('dropdown-menu').item(0);
        if (typeof dropdownMenu !== "undefined") {
          return dropdownMenu.children.length > 0;
        }
      }
      return false;
    },
    available: function (action) {
      return this.filled(this.array_get(this.urls, 'batch_' + action));
    },
    doBatch: function (action, confirm = false) {
      let url = this.array_get(this.urls, 'batch_' + action);

      if (this.filled(url)) {
        if (confirm) {
          this.$swal({
            title: this.array_get(this.trans, 'ui.message.' + action + '_alert_title'),
            text: this.array_get(this.trans, 'ui.message.' + action + '_alert_message'),
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

            this.runAjax(url, action);
          });
        } else {
          this.runAjax(url, action);
        }
      }
    },
    runAjax: function (url, action) {
      let message;
      if (action === 'destroy' || action === 'trash') {
        message = this.array_get(this.trans, 'ui.message.destroying');
      } else if (action === 'export') {
        message = this.array_get(this.trans, 'ui.message.exporting');
      } else {
        message = this.array_get(this.trans, 'ui.message.updating');
      }

      this.$swal({
        title: message,
        icon: 'info',
        showConfirmButton: false,
        allowOutsideClick: false
      });

      axios
        .patch(url, {selected: this.currentSelected})
        .then((response) => {
          if (response.data.code === '0000') {
            if (action === 'export') {
              location.href = url + '#records';
            } else if (this.filled(response.data.redirect_to)) {
              location.href = response.data.redirect_to;
            } else {
              this.$emit('batched');
              this.$swal.close();
            }
          } else {
            this.$swal({text: response.data.message, icon: 'error'});
          }
        })
        .catch((error) => {
          this.$swal({text: error.message, icon: 'error'});
        });
    }
  }
}
</script>
