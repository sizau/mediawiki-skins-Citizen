# 自定义页脚链接配置指南

本功能允许您在 Citizen 皮肤的页脚添加自定义链接，如 ICP 备案号、公安备案号等。

## 功能特点

- ✅ 不受国际化系统影响（`uselang=qqx` 也不会显示消息键）
- ✅ 支持外部链接自动添加 `rel="noreferrer noopener"` 和 `target="_blank"`
- ✅ 灵活配置，可以添加任意数量的自定义链接

## 配置方法

在您的 `LocalSettings.php` 文件中添加以下配置：

### 1. 添加 ICP 备案号

```php
$wgCitizenFooterICPRecord = [
    'text' => '苏ICP备2022013164号',
    'url' => 'https://beian.miit.gov.cn/',
    'title' => '中华人民共和国工业和信息化部 - ICP/IP地址/域名信息备案管理系统',
    'icon' => '/resources/assets/icp-icon.png'  // 可选：添加图标
];
```

生成的 HTML：
```html
<li id="footer-places-icprecord">
    <a href="https://beian.miit.gov.cn/" 
       title="中华人民共和国工业和信息化部 - ICP/IP地址/域名信息备案管理系统"
       rel="noreferrer noopener" 
       target="_blank">
        <img src="/resources/assets/icp-icon.png" alt="" style="vertical-align: middle; margin-right: 4px;">
        苏ICP备2022013164号
    </a>
</li>
```

### 2. 添加公安备案号（带图标）

```php
$wgCitizenFooterPSBRecord = [
    'text' => '苏公网安备32021302000963号',
    'url' => 'http://beian.mps.gov.cn/',
    'title' => '中华人民共和国公安部 - 全国互联网安全管理平台',
    'icon' => '/resources/assets/beian.png'  // 公安备案图标
];
```

生成的 HTML：
```html
<li id="footer-places-psbrecord">
    <a href="http://beian.mps.gov.cn/" 
       title="中华人民共和国公安部 - 全国互联网安全管理平台"
       rel="noreferrer noopener" 
       target="_blank">
        <img src="/resources/assets/beian.png" alt="" style="vertical-align: middle; margin-right: 4px;">
        苏公网安备32021302000963号
    </a>
</li>
```
$wgCitizenFooterCustomLinks = [
    'uptime' => [
        'text' => '状态监测',
        'url' => 'https://uptimemonitor.example.com',
        'title' => '状态监测',
        'icon' => '/resources/assets/uptime-icon.png'  // 可选：添加图标
    ],
    'report' => [
        'text' => '投诉举报',
        'url' => '/wiki/Project:投诉举报处理方针',
        'title' => '投诉举报'
    ],
    'terms' => [
        'text' => '用户协议',
        'url' => '/wiki/Project:用户协议',
        'title' => '用户协议'
    ]
];
```     'url' => '/wiki/Project:用户协议',
        'title' => '用户协议'
    ]
];
```

生成的 HTML：
```html
<li id="footer-places-uptime">
    <a href="https://uptimemonitor.example.com" 
       title="状态监测"
       rel="noreferrer noopener" 
       target="_blank">状态监测</a>
</li>
<li id="footer-places-report">
    <a href="/wiki/Project:投诉举报处理方针" 
       title="投诉举报">投诉举报</a>
</li>
<li id="footer-places-terms">
    <a href="/wiki/Project:用户协议" 
       title="用户协议">用户协议</a>
</li>
```

## 完整示例

```php
// 在 LocalSettings.php 的最后添加

// ICP 备案号
$wgCitizenFooterICPRecord = [
    'text' => '苏ICP备2022013164号',
    'url' => 'https://beian.miit.gov.cn/',
    'title' => '中华人民共和国工业和信息化部 - ICP/IP地址/域名信息备案管理系统'
];
// 公安备案号（带图标）
$wgCitizenFooterPSBRecord = [
    'text' => '苏公网安备32021302000963号',
    'url' => 'http://beian.mps.gov.cn/',
    'title' => '中华人民共和国公安部 - 全国互联网安全管理平台',
    'icon' => '/resources/assets/beian.png'
];  'title' => '中华人民共和国公安部 - 全国互联网安全管理平台'
];

// 其他自定义链接
$wgCitizenFooterCustomLinks = [
    'uptime' => [
        'text' => '状态监测',
        'url' => 'https://uptimemonitor.gongbiquanshu.cn',
        'title' => '状态监测'
    ],
    'terms' => [
        'text' => '用户协议',
        'url' => 'https://www.qiuwenbaike.cn/wiki/Qiuwen:用户协议',
        'title' => '用户协议'
    ],
    'general' => [
        'text' => '共同纲领',
        'url' => 'https://www.qiuwenbaike.cn/wiki/Qiuwen:共同纲领',
        'title' => '共同纲领'
    ],
    'report' => [
        'text' => '投诉举报',
        'url' => 'https://www.qiuwenbaike.cn/wiki/Qiuwen:投诉举报处理方针',
        'title' => '投诉举报'
    ],
    'opensource' => [
        'text' => '开源声明',
        'url' => '/wiki/Special:Version',
        'title' => '开源声明'
    ]
];
```

## 配置说明

- **`text`** (必需): 显示的链接文本
- **`url`** (必需): 链接地址
  - 外部链接（以 `http://` 或 `https://` 开头）会自动添加 `rel="noreferrer noopener"` 和 `target="_blank"`
  - 内部链接（相对路径）不会添加额外属性
- **`title`** (可选): 鼠标悬停时显示的提示文本
  - 如果不提供，会使用 `text` 的值
- **`icon`** (可选): 图标 URL
  - 图标会显示在文本前面
  - 自动设置为垂直居中对齐
  - 建议使用 16x16 或 20x20 像素的图标
- **`title`** (可选): 鼠标悬停时显示的提示文本
  - 如果不提供，会使用 `text` 的值

### ID 命名规则

生成的 `<li>` 元素 ID 格式为：`footer-places-{key}`

例如：
- `icprecord` → `footer-places-icprecord`
- `uptime` → `footer-places-uptime`

## 显示顺序

自定义链接会按以下顺序添加到页脚：

1. MediaWiki 默认的页脚链接（隐私政策、关于、免责声明等）
2. ICP 备案号（如果配置了 `$wgCitizenFooterICPRecord`）
3. 公安备案号（如果配置了 `$wgCitizenFooterPSBRecord`）
4. 自定义链接（按 `$wgCitizenFooterCustomLinks` 数组的顺序）

## 注意事项

1. **安全性**: 所有文本和 URL 都会自动进行 HTML 转义，防止 XSS 攻击
2. **外部链接**: 系统会自动识别外部链接并添加安全属性
3. **不受国际化影响**: 这些链接的文本是硬编码的，不会被翻译系统影响
4. **响应式布局**: 链接会自动适应移动端和桌面端布局

## 禁用功能

如果不需要这些功能，只需删除或注释掉相关配置即可：

```php
// 禁用 ICP 备案号
$wgCitizenFooterICPRecord = null;

// 禁用公安备案号
$wgCitizenFooterPSBRecord = null;

// 禁用自定义链接
$wgCitizenFooterCustomLinks = [];
```

## 技术实现

本功能通过 MediaWiki 的 `SkinAddFooterLinks` Hook 实现，确保：
- 与 MediaWiki 核心功能完全兼容
- 不会影响其他扩展或皮肤
- 支持缓存机制
- 性能开销最小
