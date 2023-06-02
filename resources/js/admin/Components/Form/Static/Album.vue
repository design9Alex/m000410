<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label"
           :style="filled(configs.modified) ? {'text-decoration': 'underline dashed red 1px'} : {}">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div v-if="blank(currentValue) || filled(hint)" :class="['col-sm-' + options.size]">
      <div v-if="blank(currentValue)" class="form-text text-muted">
        {{ array_get(trans, 'ui.message.empty_list') }}
      </div>
      <small v-if="filled(hint)" class="form-text text-muted">
        <span v-html="hint"></span>
      </small>
    </div>
    <div v-if="filled(currentValue)" class="ml-sm-auto col-sm-10 file-img-list" :class="{'mt-3': filled(hint)}">
      <div v-for="(pic, index) in currentValue" class="card mr-2 d-inline-block ui-sortable-handle">
        <input type="text" class="form-control form-control-sm mb-1" :value="pic.path" disabled>
        <a @click="showPreview(index)" class="thumb">
          <span class="imgFill imgLiquid_bgSize imgLiquid_ready"
                v-bind:style="thumbnailStyle(asset(pic.path))">
            <img :src="asset(pic.path)" style="display:none" alt="" />
          </span>
        </a>
        <div class="form-row mt-1">
          <div class="col text-center">
            <div class="btn-group btn-group-sm justify-content-center">
              <button type="button" class="btn btn-outline-default"
                      :title="array_get(trans, 'ui.button.image_info')"
                      @click="showDetail(index)"><i class="icon-wrench"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog" aria-modal="true"
         v-if="currentDetail !== null"
         @click="hideDetail($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a data-toggle="tab" role="tab" class="nav-link active">
                  {{ array_get(trans, 'ui.topic.image_info') }}
                </a>
              </li>
            </ul>
            <div class="tab-content mt-4">
              <div role="tabpanel" class="tab-pane fade show active">
                <div class="row">
                  <div class="col-lg-6">
                    <fieldset>
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.base') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.path') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.path }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.title') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.title }}</div>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset class="mt-4">
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.media') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.media') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.media }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.autoplay') }}</label>
                        <div class="col-sm-9">
                          <div v-if="parseInt(currentDetail.autoplay) === 1" class="form-text">
                            {{ array_get(trans, 'ui.image_label.autoplay_on') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.autoplay_off') }}</div>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset class="mt-4">
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.advance') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.cover') }}</label>
                        <div class="col-sm-9">
                          <div v-if="parseInt(currentDetail.cover) === 1" class="form-text">
                            {{ array_get(trans, 'ui.image_label.cover_on') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.cover_off') }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.device') }}</label>
                        <div class="col-sm-9">
                          <div v-if="currentDetail.device === 'desktop'" class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_desktop') }}</div>
                          <div v-else-if="currentDetail.device === 'pad'" class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_pad') }}</div>
                          <div v-else-if="currentDetail.device === 'mobile'" class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_mobile') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_all') }}</div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.spot') }}</label>
                        <div class="col-sm-4">
                          <div class="form-text" v-if="filled(currentDetail.spot_x)">X: {{ currentDetail.spot_x }} %</div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-text" v-if="filled(currentDetail.spot_y)">Y: {{ currentDetail.spot_y }} %</div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-lg-6">
                    <img :src="asset(currentDetail.path)" style="max-width: 100%" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button"
                    @click="currentDetail = null">{{ array_get(trans, 'ui.button.cancel') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="currentDetail !== null"></div>

    <div class="preview-mask" v-if="currentPreview !== null" @click="hidePreview($event)">
      <div class="preview-wrapper">
        <div class="preview-close">
          <i class="icon-cross2"></i>
        </div>
        <div class="preview-image">
          <img :src="currentPreview.path" alt="" style="max-width: 80%; max-height: 90%" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Album",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultOptions: {
        size: 10,
        limit: null,
        required: false,
        hint: null
      },
      defaultValue: {
        path: null,
        title: null,
        media: null,
        autoplay: 0,
        device: 'all',
        cover: 0,
      },
      currentDetail: null,
      currentPreview: null
    }
  },
  watch: {
    currentDetail: function (value) {
      if (value === null) {
        document.body.classList.remove("modal-open");
      } else {
        document.body.classList.add("modal-open");
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
    currentValue: {
      get: function () {
        return this.blank(this.value) ? [] : this.value.map((pic) => {
          return {...this.defaultValue, ...pic};
        });
      },
      set: function (value) {
        this.$emit('input', value);
      }
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
    }
  },
  methods: {
    initValue: function (value) {
      if (typeof value === 'boolean') {
        return value ? 1 : 0;
      }
      return value;
    },
    modalHeight: function () {
      if (window) {
        return window.innerHeight * 0.80 - 60;
      }
      return 0;
    },
    hideDetail: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.currentDetail = null;
      }
    },
    hidePreview: function ($event) {
      if ($event.target.tagName !== 'IMG') {
        this.currentPreview = null;
      }
    },
    showPreview: function (index) {
      this.currentPreview = {
        path: this.asset(this.array_get(this.currentValue, index + '.path'))
      };
    },
    asset: function (path) {
      if (this.blank(path)) {
        return null;
      }

      if (this.blank(this.configs.root)) {
        return path;
      }

      if (/^http/.test(path)) {
        return path;
      }

      return this.configs.root.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
    },
    thumbnailStyle: function (path) {
      return {
        backgroundImage: "url(" + encodeURI(path) + ")",
        backgroundSize: "cover",
        backgroundPosition: "center center",
        backgroundRepeat: "no-repeat"
      };
    },
    showDetail: function (index) {
      this.currentDetail = this.currentValue[index];
      this.currentDetail.index = index;
    },
    updateDetail: function (index) {
      let value = this.currentValue;
      for (let key in this.currentDetail) {
        if (key !== 'index' && this.currentDetail.hasOwnProperty(key)) {
          value[index][key] = this.currentDetail[key];
        }
      }
      this.currentValue = value;
      this.currentDetail = null;
    }
  }
}
</script>

<style scoped>
.preview-mask {
  position: fixed;
  z-index: 1040;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(30, 30, 30, .87);
  display: table;
  transition: opacity 0.15s linear;
  overflow-y: scroll;
}
.preview-wrapper {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}
.preview-close {
  width: 44px;
  height: 44px;
  line-height: 44px;
  text-align: center;
  position: absolute;
  top: 0;
  right: 0;
  color: #dddddd;
  z-index: 1041;
  background-color: rgba(30, 30, 30, .6);
  box-sizing: border-box;
  cursor: pointer;
  vertical-align: top;
  font-size: 1.2em;
}
.preview-close:hover {
  background-color: rgba(0, 0, 0, .8);
}
</style>
