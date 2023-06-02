<template>
  <div class="form-group row" :class="{'len': configs.language}">
    <label class="col-sm-2 col-form-label" :for="configs.key.replaceAll('.', '-')">
      {{ label }}<span class="text-danger ml-1" v-if="options.required">*</span>
    </label>
    <div :class="['col-sm-' + options.size]">
      <button class="btn btn-secondary" type="button" @click="fileManagerShow = true">
        <i class="icon-pictures"></i> {{ array_get(trans, 'ui.button.media') }}
      </button>
    </div>
    <small v-if="filled(hint)" class="form-text text-muted ml-sm-auto col-sm-10">
      <span v-html="hint"></span>
    </small>
    <div v-if="filled(currentValue)" class="ml-sm-auto col-sm-10 mt-3 file-img-list"
         @dragover="moving"
         @drop="moveReceived">
      <div v-for="(pic, index) in currentValue" class="card mr-2 d-inline-block ui-sortable-handle"
           draggable="true"
           @dragstart="moveStart($event, index)">
        <input type="text" class="form-control form-control-sm mb-1" :value="pic.path" disabled>
        <a @click="showPreview(index)" class="thumb">
          <span class="imgFill imgLiquid_bgSize imgLiquid_ready"
                v-bind:style="thumbnailStyle(asset(pic.path))">
            <img :src="asset(pic.path)" style="display:none" alt="" />
          </span>
          <span v-if="pic.cover.toString() === '1'" class="is-cover"><i class="icon-star"></i></span>
          <span v-if="filled(pic.media)" class="is-video"><i class="icon-play-outline"></i></span>
        </a>
        <div class="form-row mt-1">
          <div class="col text-center">
            <div class="btn-group btn-group-sm justify-content-center">
              <button type="button" class="btn btn-outline-default"
                      :title="array_get(trans, 'ui.button.destroy')"
                      @click="removeImage(index)"><i class="icon-trash2"></i></button>
              <button type="button" class="btn btn-outline-default"
                      :title="array_get(trans, 'ui.button.image_info')"
                      @click="editDetail(index)"><i class="icon-wrench"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog"
         v-if="fileManagerShow"
         @click="hideFileManager($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ array_get(trans, 'ui.topic.file_picker') }}
              <small class="text-muted ml-3">{{ array_get(trans, 'ui.topic.file_hint') }}</small>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click="fileManagerShow = false">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0 pl-0 pr-0 pb-0" v-bind:style="{height: modalHeight() + 'px'}">
            <file-manager v-bind:settings="settings"></file-manager>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="fileManagerShow"></div>

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
                          <input type="text" class="form-control" v-model="currentDetail.title">
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
                          <input type="text" class="form-control" v-model="currentDetail.media" placeholder="https://">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.autoplay') }}</label>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-autoplay-0" value="0"
                                   class="custom-control-input" v-model="currentDetail.autoplay">
                            <label for="image-autoplay-0" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.autoplay_off') }}</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-autoplay-1" value="1"
                                   class="custom-control-input" v-model="currentDetail.autoplay">
                            <label for="image-autoplay-1" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.autoplay_on') }}</label>
                          </div>
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
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-cover-0" value="0"
                                   class="custom-control-input" v-model="currentDetail.cover">
                            <label for="image-cover-0" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.cover_off') }}</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-cover-1" value="1"
                                   class="custom-control-input" v-model="currentDetail.cover">
                            <label for="image-cover-1" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.cover_on') }}</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.device') }}</label>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-device-all" value="all"
                                   class="custom-control-input" v-model="currentDetail.device">
                            <label for="image-device-all" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.device_all') }}</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-device-desktop" value="desktop"
                                   class="custom-control-input" v-model="currentDetail.device">
                            <label for="image-device-desktop" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.device_desktop') }}</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-device-pad" value="pad"
                                   class="custom-control-input" v-model="currentDetail.device">
                            <label for="image-device-pad" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.device_pad') }}</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline"
                               style="position: relative; top: auto; right: auto; margin-right: 1rem;">
                            <input type="radio" id="image-device-mobile" value="mobile"
                                   class="custom-control-input" v-model="currentDetail.device">
                            <label for="image-device-mobile" class="custom-control-label">
                              {{ array_get(trans, 'ui.image_label.device_mobile') }}</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.spot') }}</label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" v-model="currentDetail.spot_x" placeholder="X %">
                        </div>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" v-model="currentDetail.spot_y" placeholder="Y %">
                        </div>
                        <small class="form-text text-muted ml-sm-auto col-sm-9">
                          {{ array_get(trans, 'ui.image_label.spot_hint') }}
                        </small>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-lg-6">
                    <img :src="asset(currentDetail.path)" style="max-width: 100%" alt="" class="img-fluid" @click="getPixel">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button"
                    @click="currentDetail = null">{{ array_get(trans, 'ui.button.cancel') }}</button>
            <button class="btn btn-primary" type="button"
                    @click="updateDetail(currentDetail.index)">{{ array_get(trans, 'ui.button.submit') }}</button>
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
import en from 'laravel-file-manager/src/lang/en';
import zh_CN from 'laravel-file-manager/src/lang/zh_CN';
import zh_TW from 'laravel-file-manager/src/lang/zh_TW';

export default {
  name: "Images",
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
        spot_x: null,
        spot_y: null,
      },
      dialog: {
        init: null,
        mySubmit: null
      },
      currentDetail: null,
      currentPreview: null,
      fileManagerShow: false
    }
  },
  mounted() {
    this.dialog.init = this.dialogInit;
    this.dialog.mySubmit = this.dialogMySubmit;
  },
  watch: {
    fileManagerShow: function (status) {
      if (status) {
        this.$store.commit('fm/setFileCallBack', (fileUrl) => {
          this.dialog.mySubmit(fileUrl);
        });
        document.body.classList.add("modal-open");
      } else {
        document.body.classList.remove("modal-open");
      }
    },
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
    settings: function () {
      return {
        baseUrl: this.configs.fm_base,
        lang: this.getLanguage(),
        translation: this.getTranslation()
      };
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
    getLanguage: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return 'zh-TW';
        case 'zh-CN':
          return 'zh-CN';
        default:
          return 'en-US';
      }
    },
    getTranslation: function () {
      switch (document.documentElement.lang) {
        case 'zh-TW':
          return {name: 'zh-TW', content: zh_TW};
        case 'zh-CN':
          return {name: 'zh-CN', content: zh_CN};
        default:
          return {name: 'en-US', content: en};
      }
    },
    dialogInit: function () {
    },
    dialogMySubmit: function (URL) {
      // pass selected file path back
      let extensionRegex = new RegExp('.(png|jpg|jpeg|jp2|gif|svg|webp|bmp)$', 'i');

      if (extensionRegex.test(URL)) {
        this.pushImage('/' + URL.split('/').slice(this.configs.root.split('/').length).join('/'));
      } else {
        this.$swal({text: this.array_get(this.trans, 'ui.message.image_type'), icon: 'warning'});
      }
    },
    hideFileManager: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.fileManagerShow = false;
      }
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
    moveStart: function ($event, index) {
      $event.dataTransfer.setData("text/plain", index);
      $event.dropEffect = "move";
    },
    moving: function ($event) {
      $event.preventDefault();
      $event.dataTransfer.dropEffect = "move";
    },
    moveReceived: function ($event) {
      $event.preventDefault();
      let index = parseInt($event.dataTransfer.getData("text"));
      let target = $event.target.closest('.file-img-list > .card');
      let targetIndex = target === null
        ? this.currentValue.length - 1
        : Array.from(target.parentNode.children).indexOf(target);
      this.sortImage(index, targetIndex);
    },
    sortImage: function (sourceIndex, targetIndex) {
      if (sourceIndex === targetIndex) {
        return;
      }

      let sorted = [];
      for (let index in this.currentValue) {
        if (!this.currentValue.hasOwnProperty(index)) continue;

        if (parseInt(index) === sourceIndex) continue;

        if (sourceIndex < targetIndex) {
          sorted.push(this.currentValue[index]);
        }

        if (parseInt(index) === targetIndex) {
          sorted.push(this.currentValue[sourceIndex]);
        }

        if (sourceIndex > targetIndex) {
          sorted.push(this.currentValue[index]);
        }
      }

      this.currentValue = sorted;
    },
    pushImage: function (url) {
      let currentValue = this.currentValue;
      if (this.filled(this.options.limit) && currentValue.length + 1 > this.options.limit) {
        this.fileManagerShow = false;
        this.$swal({
          text: this.array_get(this.trans, 'ui.message.image_limit'),
          icon: "warning"
        });
        return;
      }

      currentValue.push({...this.defaultValue, ...{path: url}});
      this.currentValue = currentValue;

      if (this.filled(this.options.limit) && currentValue.length >= this.options.limit) {
        this.fileManagerShow = false;
      }
    },
    removeImage: function (index) {
      let value = this.currentValue;
      value.splice(index, 1);
      this.currentValue = value;
    },
    editDetail: function (index) {
      this.currentDetail = Object.assign({}, this.currentValue[index]);
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
    },
    getPixel: function(e) {
      let domX = e.x - e.target.getBoundingClientRect().left;
      let domY = e.y - e.target.getBoundingClientRect().top;

      this.currentDetail.spot_x = Math.round(domX * 100 / e.target.offsetWidth);
      this.currentDetail.spot_y = Math.round(domY * 100 / e.target.offsetHeight);
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
a.thumb {
  position: relative;
}
a.thumb .is-cover,
a.thumb .is-video {
  display: block;
  position: absolute;
  width: 30px;
  height: 30px;
  margin: 0;
  font-size: 20px;
  line-height: 30px;
  text-align: center;
  background-color: rgba(255, 255, 255, .8);
  overflow: hidden;
}
a.thumb .is-cover {
  left: 3px;
  top: 3px;
  color: #eeac07;
  border-radius: 0 0 5px 0;
}
a.thumb .is-video {
  right: 3px;
  bottom: 3px;
  color: #d31f1f;
  border-radius: 5px 0 0 0;
}
</style>
