<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div class="col-sm-10 table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="thead-default">
        <tr class="text-left">
          <th class="w-20">{{ array_get(trans, 'ui.operation_label.title') }}</th>
          <th>{{ array_get(trans, 'ui.operation_label.deny_permissions') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(option, index) in options.options">
          <td>{{ option.label }}</td>
          <td>
            <div
              v-for="permission in options.permissions"
              class="custom-control custom-checkbox custom-control-inline mb-2">
              <input class="custom-control-input" type="checkbox"
                     :id="configs.key.replaceAll('.', '-') + '-' + index + '-' + permission"
                     :value="{role: option.value, permission: permission}"
                     v-model="currentValue" />
              <label class="custom-control-label"
                     :for="configs.key.replaceAll('.', '-') + '-' + index + '-' + permission">
                {{ array_get(trans, 'ui.operation_label.' + permission) }}
              </label>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
  </div>
</template>

<script>
export default {
  name: "RoleOperations",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        placeholder: null,
        required: false,
        hint: null,
        options: {},
        permissions: ['invisible', 'unusable', 'unselectable', 'unmodifiable', 'indelible']
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
    },
    currentValue: {
      get: function () {
        if (this.blank(this.value)) {
          return [];
        }

        let permissions = [];
        for (let role_id in this.value) {
          for (let index in this.value[role_id]) {
            permissions.push({role: role_id, permission: this.value[role_id][index]});
          }
        }

        return permissions;
      },
      set: function (value) {
        let operations = {};
        if (this.filled(value)) {
          for (let index in value) {
            if (operations.hasOwnProperty(value[index].role)) {
              operations[value[index].role].push(value[index].permission);
            } else {
              operations[value[index].role] = [value[index].permission];
            }
          }
        }

        if (JSON.stringify(operations) !== JSON.stringify(this.value)) {
          this.$emit('input', this.filled(operations) ? operations : null);
        }
      }
    }
  }
}
</script>
