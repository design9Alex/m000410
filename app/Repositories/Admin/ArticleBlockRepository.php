<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Minmax\Article\Admin\ArticleCategoryRepository;
use Minmax\Article\Models\ArticleBlock;


use Minmax\Article\Admin\ArticleBlockRepository as BaseRepository;
use Minmax\Base\Admin\RoleRepository;

/**
 * Class ArticleBlockRepository
 *
 * @package Minmax\Article\Admin
 * @property ArticleBlock $model
 * @method ArticleBlock find($id)
 * @method ArticleBlock one($column = null, $operator = null, $value = null, $boolean = 'and')
 * @method ArticleBlock[]|Collection all($column = null, $operator = null, $value = null, $boolean = 'and')
 * @method ArticleBlock create($attributes)
 * @method ArticleBlock save($model, $attributes)
 * @method ArticleBlock serialization($attributes = null)
 * @method ArticleBlock|\Illuminate\Database\Eloquent\Builder query()
 */
class ArticleBlockRepository extends BaseRepository
{

    public function getUiOptions(Request $request, $action = null)
    {
        return [
            'articleCategories' => [
                'label' => __('MinmaxArticle::admin.module.ArticleBlock.articleCategories'),
                'filterable' => true,
                'options' => (new ArticleCategoryRepository)->getOptions('article-block', false, $action !== 'index')
            ],
            'roles' => [
                'label' => __('MinmaxArticle::admin.module.ArticleBlock.roles'),
                'filterable' => false,
                'options' => (new RoleRepository)->getOptions(['admin'], false)
            ],
            'operations' => [
                'label' => __('MinmaxArticle::admin.module.ArticleBlock.operations'),
                'filterable' => false,
                'options' => systemOption('operation')
            ],
            'active' => [
                'label' => __('MinmaxArticle::admin.module.ArticleBlock.active'),
                'filterable' => true,
                'options' => systemOption('switcher')
            ],

            'financial_type' => [
                'label' => __('admin.module.ArticleBlock.financial_type'),
                'filterable' => false,
                'options' => siteOption('financial_type')
            ],

        ];
    }


}
