<template>
  <base-create :urls="urls" :configs="configs" ref="baseCreate">
    <fieldset v-for="(columns, fieldSet, index) in baseCreate.columns" :class="{'mt-4': index > 0}">
      <legend class="legend h6 mb-4">
        <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.' + fieldSet) }}</legend>

      <component
        v-for="column in columns"
        v-if="columnCondition(column)"
        :is="column.component"
        :key="'field_' + column.key"
        :trans="trans"
        :configs="getComponentConfigs(column)"
        v-model="liveValues[column.key]"></component>

    </fieldset>

    <div class="text-center my-4 form-btn-group">
      <b-overlay
        :show="$store.state.formBusy"
        opacity="0.6"
        spinner-small
        spinner-variant="main"
        class="d-inline-block">
        <button
          class="btn btn-main"
          type="button"
          @click="submitForm(trans)">
          {{ array_get(trans, 'ui.button.submit') }}</button>
      </b-overlay>
      <button
        class="btn btn-default"
        type="button"
        :disabled="$store.state.formBusy"
        @click="getData">
        {{ array_get(trans, 'ui.button.reset') }}</button>
    </div>
  </base-create>
</template>

<script>
import { Base64 } from 'js-base64';
import BaseCreate from "../../Components/Layout/BaseCreate";
import DefaultCreate from "../../Components/Mixins/DefaultCreate";

import MinmaxAddress from "../../Components/Form/Address";
import MinmaxAgreement from "../../Components/Form/Agreement";
import MinmaxCheckbox from "../../Components/Form/Checkbox";
import MinmaxCustomOptions from "../../Components/Form/CustomOptions";
import MinmaxDate from "../../Components/Form/Date";
import MinmaxDatetime from "../../Components/Form/Datetime";
import MinmaxEditor from "../../Components/Form/Editor";
import MinmaxFiles from "../../Components/Form/Files";
import MinmaxImages from "../../Components/Form/Images";
import MinmaxInputText from "../../Components/Form/InputText";
import MinmaxMultiSelect from "../../Components/Form/MultiSelect";
import MinmaxRadio from "../../Components/Form/Radio";
import MinmaxReferrerTags from "../../Components/Form/ReferrerTags";
import MinmaxSelect from "../../Components/Form/Select";
import MinmaxTextarea from "../../Components/Form/Textarea";
import MinmaxTextTags from "../../Components/Form/TextTags";

import MinmaxAlbum from "../../Components/Form/Static/Album";
import MinmaxCollection from "../../Components/Form/Static/Collection";
import MinmaxEditorPreview from "../../Components/Form/Static/EditorPreview";
import MinmaxFileList from "../../Components/Form/Static/FileList";
import MinmaxFullAddress from "../../Components/Form/Static/FullAddress";
import MinmaxOptionList from "../../Components/Form/Static/OptionList";
import MinmaxPlainTags from "../../Components/Form/Static/PlainTags";
import MinmaxPlainText from "../../Components/Form/Static/PlainText";
import MinmaxSelection from "../../Components/Form/Static/Selection";

export default {
  name: "CommonCreate",
  mixins: [DefaultCreate],
  components: {
    BaseCreate,
    MinmaxAddress,
    MinmaxAgreement,
    MinmaxCheckbox,
    MinmaxCustomOptions,
    MinmaxDate,
    MinmaxDatetime,
    MinmaxEditor,
    MinmaxFiles,
    MinmaxImages,
    MinmaxInputText,
    MinmaxMultiSelect,
    MinmaxRadio,
    MinmaxReferrerTags,
    MinmaxSelect,
    MinmaxTextarea,
    MinmaxTextTags,
    MinmaxAlbum,
    MinmaxCollection,
    MinmaxEditorPreview,
    MinmaxFileList,
    MinmaxFullAddress,
    MinmaxOptionList,
    MinmaxPlainTags,
    MinmaxPlainText,
    MinmaxSelection
  },
  computed: {
    baseCreate: {
      get: function () {
        if (this.$refs.baseCreate) {
          return this.$refs.baseCreate;
        }

        return {};
      },
      cache: false
    },
    trans: {
      get: function () {
        if (this.baseCreate.trans) {
          return this.baseCreate.trans;
        }
        return {};
      },
      cache: false
    }
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseCreate.options);
      }

      return configs;
    },
    columnCondition: function (column) {
      let condition = column.condition;

      if (this.blank(condition)) {
        return true;
      }

      if (typeof condition === 'boolean') {
        return condition;
      }

      if (typeof condition === 'string') {
        return eval(Base64.decode(condition));
      }

      return false;
    }
  }
}
</script>
