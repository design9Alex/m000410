<template>
  <nav class="fixed-sidebar-left left-width">
    <ul class="side-nav" id="layout-menu-nicescroll">
      <template v-for="(menuRoot, classIndex) in menus">
        <li v-if="isAvailable(menuRoot) && classIndex !== 0"><hr class="mb-0"></li>
        <li v-if="isAvailable(menuRoot)" class="navigation-header">
          <span>{{ menuRoot.title }}</span><i class="icon-dots-three-horizontal"></i>
        </li>
        <template v-if="isAvailable(menuRoot)" v-for="menuClass in menuRoot.children">
          <li v-if="isAvailable(menuClass) && blank(menuClass.url)">
            <a class="collapsed" :class="{'active': isActive(menuClass)}"
               href="javascript:void(0);"
               data-toggle="collapse"
               :data-target="'#Menu_' + menuClass.id"
               @click="$emit('toggle-menu', true)">
              <div class="float-left">
                <i v-if="filled(menuClass.icon)" :class="menuClass.icon"></i><span class="right-nav-text">{{ menuClass.title }}</span>
              </div>
              <div class="float-right"><i class="icon-chevron-small-right"></i></div>
              <div class="clearfix"></div>
            </a>
            <ul class="collapse collapse-level-1" :class="{'show': isActive(menuClass)}" :id="'Menu_' + menuClass.id">
              <li v-for="menuItem in menuClass.children">
                <a :class="{'active': isActive(menuItem)}"
                   :href="getUrl(menuItem.url)"
                   :target="menuItem.target">{{ menuItem.title }}</a>
              </li>
            </ul>
          </li>
          <li v-else-if="isAvailable(menuClass) && filled(menuClass.url)">
            <a :class="{'active': isActive(menuClass)}"
               :href="getUrl(menuClass.url)"
               :target="menuClass.target">
              <div class="float-left">
                <i v-if="filled(menuClass.icon)" :class="menuClass.icon"></i><span class="right-nav-text">{{ menuClass.title }}</span>
              </div>
              <div class="clearfix"></div>
            </a>
          </li>
        </template>
      </template>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "SiteMenu",
  props: ['menuUrl', 'currentMenuId'],
  data() {
    return {
      menus: []
    }
  },
  mounted() {
    axios
      .get(this.menuUrl)
      .then((response) => {
        this.menus = response.data.data;
      });
  },
  watch: {
    menus: function () {
      this.$nextTick(function () {
        $('#layout-menu-nicescroll').slimScroll({height: '100%', color: '#878787',
          disableFadeOut: true, borderRadius: 0, size: '4px', alwaysVisible: false});
      });
    }
  },
  methods: {
    isAvailable: function (menu) {
      if (this.filled(menu.url)) {
        return true;
      }

      if (menu.children.length > 0) {
        for (let child of menu.children) {
          if (this.isAvailable(child)) {
            return true;
          }
        }
      }

      return false;
    },
    isActive: function (menu) {
      if (menu.id === this.currentMenuId) {
        return true;
      }

      for (let child of menu.children) {
        if (this.isActive(child)) {
          return true;
        }
      }

      return false;
    },
    getUrl: function (path) {
      if (this.blank(path)) {
        return 'javascript:void(0);'
      } else {
        return path;
      }
    }
  }
}
</script>
