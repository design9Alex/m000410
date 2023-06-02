<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <button class="btn btn-secondary" type="button" @click="permissionBoxShow = true">
        <i class="icon-key"></i> {{ array_get(trans, 'ui.button.permission') }} ({{ currentValue.length }})
      </button>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog"
         v-if="permissionBoxShow"
         @click="hidePermissionBox($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ array_get(trans, 'ui.button.permission') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="permissionBoxShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <template v-for="group in options.options">
              <h3 class="h6 pl-2">
                {{ group.label }}
              </h3>
              <div class="col bg-light border p-2 mb-3">
                <div class="row no-gutters">
                  <div class="col-md-6">
                    <div class="row mb-1 mt-1"
                         v-for="category in group.children.slice(0, Math.ceil(group.children.length / 2))">
                      <div class="col-4">
                        {{ category.label }}
                      </div>
                      <div class="col text-muted">
                        <div class="custom-control custom-checkbox custom-control-inline"
                             v-for="permission in category.children">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-' + permission.value"
                                 :value="permission.value"
                                 v-model="currentValue" disabled />
                          <label class="custom-control-label"
                                 :for="'permission-' + permission.value">{{ permission.label }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6" v-if="group.children.length > 1">
                    <div class="row mb-1 mt-1"
                         v-for="category in group.children.slice(Math.ceil(group.children.length / 2))">
                      <div class="col-4">
                        {{ category.label }}
                      </div>
                      <div class="col text-muted">
                        <div class="custom-control custom-checkbox custom-control-inline"
                             v-for="permission in category.children">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-' + permission.value"
                                 :value="permission.value"
                                 v-model="currentValue" disabled />
                          <label class="custom-control-label"
                                 :for="'permission-' + permission.value">{{ permission.label }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="permissionBoxShow"></div>
  </div>
</template>

<script>
export default {
  name: "PermissionList",
  props: {
    trans: Object,
    configs: Object,
    value: Array
  },
  data() {
    return {
      defaultOptions: {
        size: 10,
        options: [],
        required: false,
        hint: null
      },
      permissionBoxShow: false
    }
  },
  computed: {
    options: function () {
      if (!this.configs.hasOwnProperty('options') || this.blank(this.configs.options)) {
        return this.defaultOptions;
      }
      return {...this.defaultOptions, ...this.configs.options}
    },
    currentValue: function () {
        return this.blank(this.value) ? [] : this.value;
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
  watch: {
    permissionBoxShow: function (value) {
      if (value) {
        document.body.classList.add("modal-open");
      } else {
        document.body.classList.remove("modal-open");
      }
    }
  },
  methods: {
    hidePermissionBox: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.permissionBoxShow = false;
      }
    }
  }
}
</script>
