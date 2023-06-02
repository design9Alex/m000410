<template>
  <base-show :urls="urls" :configs="configs" ref="baseShow">
    <fieldset v-for="(columns, fieldSet, index) in baseShow.columns" :class="{'mt-4': index > 0}">
      <legend class="legend h6 mb-4">
        <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.' + fieldSet) }}
        <small v-if="fieldSet === 'log_details'" class="ml-2">
          <span class="d-inline-block alert alert-secondary p-0 pr-2 pl-2">
            {{ array_get(trans, 'module.before') }}
          </span>
          <span class="d-inline-block alert alert-success p-0 pr-2 pl-2">
            {{ array_get(trans, 'module.after') }}
          </span>
        </small>
      </legend>

      <component
        v-for="column in columns"
        v-if="columnCondition(column)"
        :is="column.component"
        :key="'field_' + column.key"
        :trans="trans"
        :configs="getComponentConfigs(column)"
        :value="array_get(liveValues, column.key)"></component>

    </fieldset>
  </base-show>
</template>

<script>
import CommonShow from "../Common/Show";
import MinmaxLogAlbum from "../../Components/Form/Log/Album";
import MinmaxLogCollection from "../../Components/Form/Log/Collection";
import MinmaxLogEditor from "../../Components/Form/Log/Editor";
import MinmaxLogFiles from "../../Components/Form/Log/Files";
import MinmaxLogOrigin from "../../Components/Form/Log/Origin";
import MinmaxLogPlainText from "../../Components/Form/Log/PlainText";
import MinmaxLogSelection from "../../Components/Form/Log/Selection";

export default {
  extends: CommonShow,
  name: "DataLogShow",
  components: {
    MinmaxLogAlbum,
    MinmaxLogCollection,
    MinmaxLogEditor,
    MinmaxLogFiles,
    MinmaxLogOrigin,
    MinmaxLogPlainText,
    MinmaxLogSelection
  }
}
</script>
