# 使用 Node.js 官方鏡像
FROM node:14

# 設置工作目錄
WORKDIR /app

# 複製 package.json 和 package-lock.json
COPY package*.json ./

# 安裝依賴
RUN npm install

# 複製應用程式碼
COPY . .

# 構建應用（如果需要）
RUN npm run build

# 暴露應用端口
EXPOSE 3000

# 啟動應用
CMD ["npm", "start"]
