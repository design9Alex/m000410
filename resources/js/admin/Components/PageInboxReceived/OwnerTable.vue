<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ array_get(trans, 'module.inboxOwners') }}</label>
    <div class="col-sm-10 table-responsive">
      <div v-if="blank(value)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_list') }}
      </div>
      <table v-else class="table table-sm table-bordered mb-1">
        <thead class="thead-default">
        <tr>
          <th class="w-25">{{ array_get(trans, 'module.inboxOwner.type') }}</th>
          <th class="w-20">{{ array_get(trans, 'module.inboxOwner.username') }}</th>
          <th>{{ array_get(trans, 'module.inboxOwner.name') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="owner in value">
          <td class="text-nowrap">
            {{ ownerType(owner) }}
          </td>
          <td class="text-nowrap">
            <a :href="ownerUrl(owner)" target="_blank">{{ ownerUsername(owner) }}</a>
          </td>
          <td>
            {{ ownerName(owner) }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "OwnerTable",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        placeholder: null,
        required: false,
        hint: null,
        options: [],
        details: []
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
    rowDetails: function () {
      let usedDetails = JSON.parse(JSON.stringify(this.options.details));

      return this.blank(usedDetails) ? [] : usedDetails;
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
    }
  }
}
</script>
