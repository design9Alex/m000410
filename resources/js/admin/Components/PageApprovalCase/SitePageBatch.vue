<template>
  <div class="btn-group btn-group-sm dropdown" role="group" v-show="batchable()">
    <button
      class="btn dropdown-toggle btn-main"
      type="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      :title="array_get(trans, 'ui.button.batch')">
      <i class="icon-hammer"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.batch') }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
      <button class="dropdown-item"
              v-if="available('destroy')"
              @click="doBatch('destroy', true)">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.destroy') }}
      </button>
      <button class="dropdown-item"
              v-if="available('trash')"
              @click="doBatch('trash', true)">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.trash') }}
      </button>
      <button class="dropdown-item"
              v-if="available('export')"
              @click="doBatch('export')">
        <i class="icon-trashcan mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.export') }}
      </button>
      <slot
        v-bind:available="available"
        v-bind:doBatch="doBatch"></slot>
      <button class="dropdown-item"
              v-if="available('approve')"
              @click="doBatch('approve')">
        <i class="icon-clipboard2 mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.approve') }}
      </button>
      <button class="dropdown-item"
              v-if="available('reject')"
              @click="doBatch('reject')">
        <i class="icon-warning mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.reject') }}
      </button>
      <button class="dropdown-item"
              v-if="available('abort')"
              @click="doBatch('abort')">
        <i class="icon-warning mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.abort') }}
      </button>
      <button class="dropdown-item"
              v-if="available('active')"
              @click="doBatch('active')">
        <i class="icon-eye mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.active') }}
      </button>
      <button class="dropdown-item"
              v-if="available('inactive')"
              @click="doBatch('inactive')">
        <i class="icon-cancel mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.inactive') }}
      </button>
    </div>
  </div>
</template>

<script>
import BaseSitePageBatch from '../Layout/SitePageBatch';

export default {
  extends: BaseSitePageBatch
}
</script>
