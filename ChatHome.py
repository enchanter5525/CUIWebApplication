import requests
loggedInUser = ""

def openChatRoom():
	option = "Enter"
	while option != 'Exit':
		user_input = input()
		inputs = user_input.split(" ")
		option = inputs[0]
		userName = inputs[1]
		if option == 'register':
			register(userName)
		if option == 'login':
			login(userName)
		if option == 'connect':
			connectToOthers(loggedInUser, userName)
	
def login(userName):
	response = requests.get("http://192.241.244.177/1PyChatApk/DisplayMessageFromDatabase.php?userName=" + userName)
	print(response.text)
	global loggedInUser
	loggedInUser = userName

def register(userName):
	response = requests.get("http://192.241.244.177/1PyChatApk/Register.php?userName=" + userName)
	print(response.text)
	login(userName)

def connectToOthers(sender, receiver):
	message = input("Enter message: ")
	response = requests.get("http://192.241.244.177/1PyChatApk/SendMessage.php?sender=" + sender + "&receiver=" + receiver + "&message="+message)
	print(response.text)

if __name__ == '__main__':
	openChatRoom()