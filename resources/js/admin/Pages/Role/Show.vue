<script>
import CommonShow from "../Common/Show";
import PagePermissionList from "../../Components/PageRole/PermissionList";

export default {
  extends: CommonShow,
  name: "RoleShow",
  components: {
    PagePermissionList
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        if (configs.key === 'permissions') {
          configs.options.options = this.array_get(this.getOptions(this.array_get(configs, 'options.options'), this.baseShow.options), this.liveValues.guard, []);
        } else {
          configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseShow.options);
        }
      }

      return configs;
    }
  }
}
</script>
