<script>
import CommonCreate from "../Common/Create";
import PagePermissions from "../../Components/PageRole/Permissions";

export default {
  extends: CommonCreate,
  name: "RoleCreate",
  components: {
    PagePermissions
  },
  watch: {
    'liveValues.guard': function (after, before) {
      if (this.filled(before) && after !== before) {
        this.liveValues.permissions = [];
      }
    }
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        if (configs.key === 'permissions') {
          configs.options.options = this.array_get(this.getOptions(this.array_get(configs, 'options.options'), this.baseCreate.options), this.liveValues.guard, []);
        } else {
          configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseCreate.options);
        }
      }

      return configs;
    }
  }
}
</script>
