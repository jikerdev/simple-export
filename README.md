# Excel 数据导出框架

这是一个简便易用的 Excel 数据导出框架，基于 PHPExcel（PhpSpreadsheet 的前身），可以用于在 PHP 应用程序中生成并导出 Excel 文件。

## 一、安装

使用 Composer 安装：

```bash
composer require jikerdev/simple-export
```

在需要使用 Excel 导出的地方引入它：

```php
use Jiker\SimpleExport\ExcelExport;
```

## 二、用法

### 1.1 基本使用

```php
// 创建导出器
$exporter = new ExcelExport('data', 'xlsx');

// 添加数据到导出器
$data = [
    ['姓名', '年龄', '性别'],
    ['Tom', 20, '男'],
    ['Lucy', 18, '女'],
    ['Jack', 22, '男']
];
$exporter->appendData($data);

// 导出文件
$exporter->download();
```

以上代码将创建一个名为 `data.xlsx` 的 Excel 文件，并将 `$data` 数组中的数据添加到 Excel 文件中。点击“下载”按钮时，将自动下载该文件。

### 1.2 自定义标题和工作表名

```php
// 创建导出器
$exporter = new ExcelExport('students', 'xlsx');
$exporter->setTitle('学生信息表');
$exporter->setTabName('成绩信息');

// 添加数据到导出器
$data = [
    ['姓名', '语文', '数学', '英语'],
    ['Tom', 85, 90, 93],
    ['Lucy', 94, 88, 91],
    ['Jack', 80, 72, 85]
];
$exporter->appendData($data);

// 导出文件
$exporter->download();
```

以上代码将创建一个名为 `students.xlsx` 的 Excel 文件，并将工作表的名称设置为“成绩信息”。Excel 文件的第一行将被设置为“学生信息表”的标题。

### 1.3 使用其他文件格式

```
```php
// 创建导出器
$exporter = new ExcelExport('data', 'csv');

// 添加数据到导出器
$data = [
    ['姓名', '年龄', '性别'],
    ['Tom', 20, '男'],
    ['Lucy', 18, '女'],
    ['Jack', 22, '男']
];
$exporter->appendData($data);

// 导出文件
$exporter->download();
```

以上代码将创建一个名为 `data.csv` 的 CSV 文件，并将数据添加到该文件中。

## 四、版权和作者

该框架遵循 MIT 许可，作者为 AI 小助手。

## 五、贡献

任何形式的贡献与反馈都是欢迎的。如果您发现了问题或者有改进的想法，请不要犹豫，随时 Fork、Issue 或 PR，我们会认真考虑和处理。
