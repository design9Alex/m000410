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
            <div class="col mb-3">
              <div class="row button-multiselect-box">
                <button type="button" class="permission-on-all btn btn-secondary btn-sm" @click="selectAll()">
                  {{ array_get(trans, 'ui.button.permission_all') }}</button>
                <button type="button" class="permission-off-all btn btn-secondary btn-sm" @click="clearAll()">
                  {{ array_get(trans, 'ui.button.permission_clear') }}</button>
              </div>
            </div>
            <template v-for="group in options.options">
              <h3 class="h6 pl-2">
                <span class="custom-control custom-checkbox custom-control-inline">
                  <input class="custom-control-input" type="checkbox"
                         :id="'permission-group-' + group.value"
                         :checked="switcherStatus(group.children, true)"
                         @change="allSwitch(group.children, true)" />
                  <label class="custom-control-label"
                         :for="'permission-group-' + group.value">{{ group.label }}</label>
                </span>
              </h3>
              <div class="col bg-light border p-2 mb-3">
                <div class="row no-gutters">
                  <div class="col-md-6">
                    <div class="row mb-1 mt-1"
                         v-for="category in group.children.slice(0, Math.ceil(group.children.length / 2))">
                      <div class="col-4">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-category-' + category.value"
                                 :checked="switcherStatus(category.children)"
                                 @change="allSwitch(category.children)" />
                          <label class="custom-control-label"
                                 :for="'permission-category-' + category.value">{{ category.label }}</label>
                        </div>
                      </div>
                      <div class="col text-muted">
                        <div class="custom-control custom-checkbox custom-control-inline"
                             v-for="permission in category.children">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-' + permission.value"
                                 :value="permission.value"
                                 v-model="currentValue" />
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
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-category-' + category.value"
                                 :checked="switcherStatus(category.children)"
                                 @change="allSwitch(category.children)" />
                          <label class="custom-control-label"
                                 :for="'permission-category-' + category.value">{{ category.label }}</label>
                        </div>
                      </div>
                      <div class="col text-muted">
                        <div class="custom-control custom-checkbox custom-control-inline"
                             v-for="permission in category.children">
                          <input class="custom-control-input" type="checkbox"
                                 :id="'permission-' + permission.value"
                                 :value="permission.value"
                                 v-model="currentValue">
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
  name: "Permissions",
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
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value;
      },
      set: function (value) {
        this.$emit('input', this.blank(value) ? null : value);
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
    },
    switcherStatus: function (children, isGroup = false) {
      if (this.blank(children)) {
        return null;
      }

      let permissions = [];
      if (isGroup) {
        for (let i in children) {
          if (children.hasOwnProperty(i) && this.filled(children[i].children)) {
            for (let j in children[i].children) {
              if (children[i].children.hasOwnProperty(j)) {
                permissions.push(children[i].children[j].value);
              }
            }
          }
        }
      } else {
        for (let i in children) {
          if (children.hasOwnProperty(i)) {
            permissions.push(children[i].value);
          }
        }
      }

      for (let index in permissions) {
        if (permissions.hasOwnProperty(index) && this.currentValue.indexOf(permissions[index]) === -1) {
          return false;
        }
      }

      return true;
    },
    allSwitch: function (children = [], isGroup = false) {
      if (this.blank(children)) {
        return;
      }

      let permissions = [];
      if (isGroup) {
        for (let i in children) {
          if (children.hasOwnProperty(i) && this.filled(children[i].children)) {
            for (let j in children[i].children) {
              if (children[i].children.hasOwnProperty(j)) {
                permissions.push(children[i].children[j].value);
              }
            }
          }
        }
      } else {
        for (let i in children) {
          if (children.hasOwnProperty(i)) {
            permissions.push(children[i].value);
          }
        }
      }

      let current = [...this.currentValue];

      if (!this.switcherStatus(children, isGroup)) {
        for (let index in permissions) {
          if (permissions.hasOwnProperty(index) && current.indexOf(permissions[index]) === -1) {
            current.push(permissions[index]);
          }
        }
      } else {
        for (let index in permissions) {
          if (permissions.hasOwnProperty(index)) {
            let searchIndex = current.indexOf(permissions[index]);
            if (searchIndex !== -1) {
              current.splice(searchIndex, 1);
            }
          }
        }
      }

      this.currentValue = current;
    },
    selectAll: function () {
      let permissions = [];
      let options = this.options.options;
      for (let k in options) {
        if (options.hasOwnProperty(k) && this.filled(options[k].children)) {
          let children = options[k].children;
          for (let i in children) {
            if (children.hasOwnProperty(i) && this.filled(children[i].children)) {
              for (let j in children[i].children) {
                if (children[i].children.hasOwnProperty(j)) {
                  permissions.push(children[i].children[j].value);
                }
              }
            }
          }
        }
      }
      this.currentValue = permissions;
    },
    clearAll: function () {
      this.currentValue = [];
    }
  }
}
</script>
