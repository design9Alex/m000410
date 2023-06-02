<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ array_get(trans, 'module.inboxOwners') }}</label>
    <div class="col-sm-10 table-responsive">
      <table class="table table-sm table-bordered mb-1">
        <thead class="thead-default">
        <tr>
          <th class="w-25">{{ array_get(trans, 'module.inboxOwner.type') }}</th>
          <th class="w-20">{{ array_get(trans, 'module.inboxOwner.username') }}</th>
          <th>{{ array_get(trans, 'module.inboxOwner.name') }}</th>
          <th class="w-5 text-center">{{ array_get(trans, 'ui.grid.actions') }}</th>
        </tr>
        </thead>
        <tbody v-if="filled(value)">
        <tr v-for="(owner, index) in value">
          <td class="text-nowrap">
            {{ ownerType(owner) }}
          </td>
          <td class="text-nowrap">
            <a :href="ownerUrl(owner)" target="_blank">{{ ownerUsername(owner) }}</a>
          </td>
          <td>
            {{ ownerName(owner) }}
          </td>
          <td class="text-center text-nowrap">
            <button class="btn btn-danger btn-sm" type="button" @click="removeOwner(index)">
              <i class="icon-cross"></i>
            </button>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td>
            <bootstrap-select
              id="InboxReceived-inboxOwners-list"
              class="form-control form-control-sm bs-select"
              :title="array_get(trans, 'ui.filter.please_select')"
              data-style="btn-outline-secondary"
              :options="options.options"
              :value="currentType"
              v-on:input="currentType = $event" />
          </td>
          <td colspan="2">
            <input
              type="text"
              class="form-control form-control-sm"
              autocomplete="false"
              :list="configs.key.replaceAll('.', '-') + '-advice'"
              :disabled="blank(currentType)"
              v-model="currentInput" />
            <datalist :id="configs.key.replaceAll('.', '-') + '-advice'" v-if="availableItems.length > 0">
              <option v-for="item in availableItems" :value="item.value">{{ item.label }}</option>
            </datalist>
          </td>
          <td class="text-center text-nowrap">
            <button
              type="button"
              class="btn btn-primary btn-sm"
              :disabled="blank(availableItems)"
              @click="addOwner()"><i class="icon-plus"></i></button>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
import BootstrapSelect from "../Module/BootstrapSelect";

export default {
  name: "OwnerInput",
  components: {
    BootstrapSelect
  },
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        placeholder: null,
        required: false,
        hint: null,
        options: [],
        details: []
      },
      liveDetails: [],
      searchTimer: null,
      currentType: null,
      currentInput: null,
      availableItems: []
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
    rowDetails: function () {
      let usedDetails = JSON.parse(JSON.stringify(this.options.details));
      for (let i in this.liveDetails) {
        let exists = false;
        for (let j in usedDetails) {
          if (this.liveDetails[i].type === usedDetails[j].type && this.liveDetails[i].id === usedDetails[j].id) {
            exists = true;
          }
        }

        if (exists) {
          this.liveDetails.splice(parseInt(i), 1);
        } else {
          usedDetails.push(this.liveDetails[i])
        }
      }

      return this.blank(usedDetails) ? [] : usedDetails;
    }
  },
  watch: {
    currentInput: function (val) {
      clearTimeout(this.searchTimer);

      let reference = null;
      for (let index in this.options.options) {
        if (this.options.options[index].value === this.currentType) {
          reference = this.options.options[index].options.reference;
        }
      }

      if (this.blank(val) || this.blank(reference)) {
        this.availableItems = [];
      } else {
        this.searchTimer = setTimeout(() => {
          axios
            .post(reference, {'keyword': val})
            .then((response) => {
              if (response.data.code === '0000') {
                this.availableItems = response.data.data;
              }
            });
        }, 300);
      }
    }
  },
  methods: {
    ownerType: function (owner) {
      for (let index in this.options.options) {
        if (this.options.options[index].options.model === owner.type) {
          return this.options.options[index].label;
        }
      }
      return null;
    },
    ownerUsername: function (owner) {
      for (let index in this.rowDetails) {
        if (this.rowDetails[index].type === owner.type && this.rowDetails[index].id === owner.id) {
          return this.rowDetails[index].username;
        }
      }
      return '-';
    },
    ownerName: function (owner) {
      for (let index in this.rowDetails) {
        if (this.rowDetails[index].type === owner.type && this.rowDetails[index].id === owner.id) {
          return this.rowDetails[index].name;
        }
      }
      return null;
    },
    ownerUrl: function (owner) {
      for (let index in this.rowDetails) {
        if (this.rowDetails[index].type === owner.type && this.rowDetails[index].id === owner.id) {
          return this.rowDetails[index].link;
        }
      }
      return null;
    },
    addOwner: function () {
      if (this.filled(this.currentInput)) {
        let currentValue = this.blank(this.value) ? [] : JSON.parse(JSON.stringify(this.value));
        let newOwner = {
          type: this.currentType,
          id: this.currentInput
        };

        for (let index in this.options.options) {
          if (this.options.options[index].value === newOwner.type) {
              newOwner.type = this.options.options[index].options.model;
          }
        }

        for (let index in currentValue) {
          if (currentValue[index].type === newOwner.type && currentValue[index].id === newOwner.id) {
            this.currentInput = null;
            return;
          }
        }

        for (let i in this.availableItems) {
          if (this.availableItems[i].value === this.currentInput) {
            this.liveDetails.push({
              type: newOwner.type,
              id: newOwner.id,
              username: this.availableItems[i].username,
              name: this.availableItems[i].name,
              link: this.availableItems[i].link,
            });
            break;
          }
        }

        currentValue.push(newOwner);

        this.$emit('input', currentValue);

        this.currentInput = null;
      }
    },
    removeOwner: function (index) {
      let currentValue = this.blank(this.value) ? [] : JSON.parse(JSON.stringify(this.value));

      currentValue.splice(parseInt(index), 1);

      this.$emit('input', currentValue);
    }
  }
}
</script>
