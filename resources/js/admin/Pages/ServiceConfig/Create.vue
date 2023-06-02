<script>
import CommonCreate from "../Common/Create";
import PageParameters from "../../Components/PageServiceConfig/Parameters";

export default {
  extends: CommonCreate,
  name: "ServiceConfigCreate",
  components: {
    PageParameters
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseCreate.options);
      }

      if (column.component === 'page-parameters') {
        configs.options = {columns: this.liveValues.parameters_map};
      }

      return configs;
    }
  }
}
</script>
