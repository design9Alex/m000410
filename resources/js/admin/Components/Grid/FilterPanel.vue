<template>
  <div class="filterTag mb-3 position-relative p-2">
    <div class="row">
      <div class="col">
        <h6 class="title p-1 d-inline-block">
          {{ array_get(trans, 'ui.filter.filter_conditions') }}{{ currentAdvanceFilter.title }}
        </h6>
      </div>
      <div class="col-auto text-right">
        <button
          class="btn btn-secondary btn-sm ml-1"
          :title="array_get(trans, 'ui.button.clear')"
          type="button"
          @click="clearFilter()">
          <i class="icon-cross"></i><!--
          --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.clear') }}</span>
        </button><!--
        --><button
          v-if="filled(currentAdvanceFilter.destroy)"
          class="btn btn-secondary btn-sm ml-1"
          :title="array_get(trans, 'ui.button.destroy')"
          type="button"
          @click="doDelete()">
          <i class="icon-trash"></i><!--
          --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.destroy') }}</span>
        </button><!--
        --><button
          v-if="filled(currentAdvanceFilter.update)"
          class="btn btn-secondary btn-sm ml-1"
          :title="array_get(trans, 'ui.button.modify')"
          type="button"
          @click="showModal('modify')">
          <i class="icon-save-disk"></i><!--
          --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.modify') }}</span>
        </button><!--
        --><button
          v-if="filled(currentAdvanceFilter.store)"
          class="btn btn-secondary btn-sm ml-1"
          :title="array_get(trans, 'ui.button.create')"
          type="button"
          @click="showModal('create')">
          <i class="icon-plus2"></i><!--
          --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.create') }}</span>
        </button>
      </div>
    </div>
    <button
      v-for="filter in currentAdvanceFilter.conditions"
      class="btn btn-light btn-sm mb-2 mr-1"
      type="button">
      <span class="text-muted">{{ getColumnText(filter) }} ({{ getRuleTypeText(filter) }})：</span><!--
      --><b class="text-dark" v-if="getConditionText(filter) !== null">{{ getConditionText(filter) }}</b>
    </button>

    <div class="modal fade show"
         style="display:block" role="dialog"
         v-if="modalShow"
         @click="hideModal($event)">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-heading-1">
            <h5 class="modal-title">
              {{ array_get(trans, 'ui.filter.custom_filter') }}
              {{ array_get(trans, 'ui.button.' + modalType) }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="modalShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <fieldset>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">{{ array_get(trans, 'ui.filter.filter_title') }}</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" v-model="filterDetail.title" />
                </div>
              </div>

              <div v-if="currentAdvanceFilter.allow_public" class="form-group row">
                <label class="col-sm-3 col-form-label">{{ array_get(trans, 'ui.filter.filter_public') }}</label>
                <div class="col-sm-9">
                  <div class="mb-2">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input
                        class="custom-control-input" type="radio"
                        id="advance-filter-public-0" name="advance_filter_public"
                        :value="0" v-model="filterDetail.public">
                      <label
                        class="custom-control-label"
                        for="advance-filter-public-0">{{ array_get(trans, 'ui.filter.public_type.private') }}</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input
                        class="custom-control-input" type="radio"
                        id="advance-filter-public-1" name="advance_filter_public"
                        :value="1" v-model="filterDetail.public">
                      <label
                        class="custom-control-label"
                        for="advance-filter-public-1">{{ array_get(trans, 'ui.filter.public_type.public') }}</label>
                    </div>
                  </div>
                  <div class="mb-2">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input
                        class="custom-control-input" type="radio"
                        id="advance-filter-public-2" name="advance_filter_public"
                        :value="2" v-model="filterDetail.public">
                      <label
                        class="custom-control-label"
                        for="advance-filter-public-2">{{ array_get(trans, 'ui.filter.public_type.roles') }}</label>
                    </div>
                    <div
                      v-for="role in currentAdvanceFilter.allow_roles"
                      class="custom-control custom-checkbox custom-control-inline">
                      <input
                        class="custom-control-input" type="checkbox"
                        :id="'advance-filter-roles-' + role.value"
                        :disabled="filterDetail.public !== 2"
                        :value="role.value" v-model="filterDetail.roles">
                      <label
                        class="custom-control-label"
                        :for="'advance-filter-roles-' + role.value">{{ role.label }}</label>
                    </div>
                  </div>
                </div>
                <small
                  class="form-text text-muted ml-sm-auto col-sm-9"
                  v-html="array_get(trans, 'ui.filter.public_hint')"></small>
              </div>
            </fieldset>
          </div>

          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              @click="modalShow = false">{{ array_get(trans, 'ui.button.cancel') }}</button>
            <button
              class="btn btn-primary"
              type="button"
              :disabled="!savable"
              @click="doSave()">{{ array_get(trans, 'ui.button.submit') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="modalShow"></div>
  </div>
</template>

<script>
export default {
  name: "GridFilterPanel",
  props: {
    urls: Object,
    trans: Object,
    options: Object,
    advanceFilterUi: Object,
    currentAdvanceFilter: Object
  },
  data() {
    return {
      modalShow: false,
      modalType: null,
      filterDetail: {
        id: null,
        menu_id: null,
        title: null,
        public: 0,
        roles: []
      }
    }
  },
  watch: {
    modalShow: function (status) {
      if (status) {
        document.body.classList.add('modal-open');
      } else {
        document.body.classList.remove('modal-open');
        this.modalType = null;
      }
    }
  },
  computed: {
    savable: function () {
      return this.filled(this.filterDetail.title);
    }
  },
  methods: {
    getColumnText: function (filter) {
      if (this.filled(this.trans) && this.filled(filter)) {
        return this.array_get(this.trans, 'module.' + filter.column);
      }
      return null;
    },
    getRuleTypeText: function (filter) {
      if (this.filled(this.trans) && this.filled(filter)) {
        return this.array_get(this.trans, 'ui.filter.rule_type.' + filter.rule_type);
      }
      return null;
    },
    getOperationText: function (filter) {
      if (this.filled(this.trans) && this.filled(filter)) {
        return this.array_get(this.trans, 'ui.filter.operation.' + filter.operation).replace(/\([>=<]+\)/, '');
      }
      return null;
    },
    getUnitText: function (filter) {
      if (this.filled(this.trans) && this.filled(filter)) {
        return this.array_get(this.trans, 'ui.filter.unit.' + filter.unit);
      }
      return null;
    },
    getCollectionText: function (filter) {
      let collectionText = '';
      if (this.filled(filter) && this.filled(filter.values)) {
        if (this.options.hasOwnProperty(filter.column)) {
          let options = this.options[filter.column].options;
          if (this.filled(options)) {
            for (let index in options) {
              if (filter.values.indexOf(options[index].value + '') !== -1) {
                collectionText += (collectionText === '' ? '' : ', ') + options[index].label;
              }
            }
          }
        }
      }
      return collectionText;
    },
    getConditionType: function (operation) {
      switch (operation) {
        case 'today':
        case 'week':
        case 'month':
        case 'quarter':
        case 'year':
        case 'empty':
          return 'selection';
        case 'equal':
        case 'greater':
        case 'lesser':
        case 'greater-equal':
        case 'lesser-equal':
        case 'all':
        case 'any':
        case 'include':
          return 'value';
        case 'past-after':
        case 'past-after-now':
        case 'past-before':
        case 'future-before':
        case 'future-before-now':
        case 'future-after':
          return 'unit';
      }

      return null;
    },
    getConditionText: function (filter) {
      let operation = this.array_get(filter, 'operation');
      let conditionType = this.getConditionType(operation);
      let operationText = this.getOperationText(filter);

      if (conditionType === 'selection') {
        return operationText;
      }

      let valueText = null;
      if (conditionType === 'value') {
        if (filter.hasOwnProperty('keyword')) {
          valueText = filter.keyword;
        } else if (filter.hasOwnProperty('datetime')) {
          valueText = filter.datetime;
        } else if (filter.hasOwnProperty('date')) {
          valueText = filter.date;
        } else if (filter.hasOwnProperty('values')) {
          valueText = this.getCollectionText(filter);
        }
      } else if (conditionType === 'unit') {
        if (filter.hasOwnProperty('amount')) {
          valueText = filter.amount + ' ' + this.getUnitText(filter);
        }
      }

      if (valueText !== null) {
        if (conditionType === 'unit') {
          return operationText.replace('...', ' ' + valueText + ' ');
        } else {
          return operationText + '：' + valueText;
        }
      }

      return null;
    },
    showModal: function (type) {
      this.filterDetail.id = this.currentAdvanceFilter.id;
      this.filterDetail.menu_id = this.currentAdvanceFilter.menu_id;
      this.filterDetail.title = this.currentAdvanceFilter.title;
      this.filterDetail.public = this.currentAdvanceFilter.public;
      this.filterDetail.roles = this.currentAdvanceFilter.roles;

      this.modalType = type;
      this.modalShow = true;
    },
    hideModal: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.modalShow = false;
      }
    },
    clearFilter: function () {
      let urlParams = new URLSearchParams(window.location.search);
      location.href = window.location.href
        .replace('filter=' + urlParams.get('filter'), '')
        .replace('filter=' + encodeURIComponent(urlParams.get('filter')), '')
        .replace(/\?\?+/, '?')
        .replace(/&&+/, '&')
        .replace(/[?&]+$/, '');
    },
    doDelete: function () {
      if (this.filled(this.currentAdvanceFilter.destroy)) {
        this.$swal({
          title: this.array_get(this.trans, 'ui.message.destroy_filter_alert_title'),
          text: this.array_get(this.trans, 'ui.message.destroy_filter_alert_message'),
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
            .delete(this.currentAdvanceFilter.destroy)
            .then((response) => {
              if (response.data.code === '0000') {
                this.$swal.close();
                this.clearFilter();
              } else {
                this.$swal({text: response.data.message, icon: 'error'});
              }
            })
            .catch((error) => {
              this.$swal({text: error.response.data.message, icon: 'error'});
            });
        });
      }
    },
    doSave: function () {
      if (this.filled(this.currentAdvanceFilter.update) && this.modalType === 'modify') {
        axios
          .put(this.currentAdvanceFilter.update, {
            title: this.filterDetail.title,
            public: this.filterDetail.public === 2 ? 1 : this.filterDetail.public,
            roles: this.filterDetail.roles,
            conditions: this.currentAdvanceFilter.conditions
          })
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('advanceFilter', response.data.data.redirect_to);
            }
          });
      } else if (this.filled(this.currentAdvanceFilter.store) && this.modalType === 'create') {
        axios
          .post(this.currentAdvanceFilter.store, {
            menu_id: this.filterDetail.menu_id,
            title: this.filterDetail.title,
            public: this.filterDetail.public === 2 ? 1 : this.filterDetail.public,
            roles: this.filterDetail.roles,
            conditions: this.currentAdvanceFilter.conditions
          })
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('advanceFilter', response.data.data.redirect_to);
            }
          });
      }
    }
  }
}
</script>
