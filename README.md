# Baiyuan AWS S3 File Explorer
Baiyuan AWS S3 File Explorer 是一款高效、易用的工具，專為管理 AWS S3 儲存桶設計。提供直觀的介面，支援檔案上傳、下載、刪除與權限設定，提升雲端檔案管理效率，適合開發者與企業用戶使用。

# 1. 準備專案目錄結構
首先，建立以下目錄和檔案結構：

# 2. 安裝必要的 PHP 套件
composer require vlucas/phpdotenv\
composer require aws/aws-sdk-php
# 3. 配置 .env 檔案
在專案根目錄下建立 .env 檔案，並填寫您的 S3 憑證相關資訊
# 4. 建立翻譯檔案
在 translations 目錄下建立 en.json 和 zh_tw.json 檔案

# 6. 打包成ZIP檔案
在您本地機器上，進入專案目錄並執行以下命令來打包成ZIP檔案\
這樣，所有需要的檔案都會被打包成一個名為 aws-s3-file-explorer.zip 的ZIP檔案。您可以將這個ZIP檔案上傳到伺服器並解壓縮，以部署您的應用程式。
