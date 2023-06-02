<script>
import CommonShow from "../Common/Show";
import PageParameterList from "../../Components/PageServiceConfig/ParameterList";

export default {
  extends: CommonShow,
  name: "ServiceConfigShow",
  components: {
    PageParameterList
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseShow.options);
      }

      if (column.component === 'page-parameter-list') {
        configs.options = {columns: this.liveValues.parameters_map};
      }

      return configs;
    }
  }
}
</script>
