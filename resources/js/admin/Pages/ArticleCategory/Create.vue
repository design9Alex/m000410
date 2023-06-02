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
      <button
        class="btn btn-dark"
        type="button"
        v-if="previewed"
        :disabled="$store.state.formBusy"
        @click="previewForm()">
        {{ array_get(trans, 'ui.button.preview') }}</button>
    </div>
  </base-create>
</template>

<script>
import CommonCreate from "../Common/Create";
import MinmaxRoleOperations from "../../Components/Form/RoleOperations";

export default {
  extends: CommonCreate,
  name: "ArticleCategoryCreate",
  components: {
    MinmaxRoleOperations
  },
  computed: {
    previewed: function () {
      return this.filled(this.urls.preview) && this.filled(this.liveValues.parent_id);
    }
  },
  methods: {
    previewForm: function () {
      axios.post(this.urls.preview, {previewData: this.liveValues})
        .then((response) => {
          if (response.data.code === '0000') {
            window.open(response.data.preview_url, 'pagePreview');
          } else {
            this.$swal({text: response.data.message, icon: 'error'});
          }
        })
        .catch((error) => {
          this.$swal({text: error.response.data.message, icon: 'error'});
        });
    }
  }
}
</script>
