from pprint import pprint
from tkinter import *
from threading import Timer
from PIL import ImageTk, Image
import os

text_file = open("usernames.txt", "r")
user = text_file.readlines()
print(user)
usernames=[]
for x in user:
        y=x.replace('\n','')
        usernames.append(y)
print(usernames)

text_file1 = open("picNames.txt", "r")
pic = text_file1.readlines()
print(pic)
picNames=[]
for x in pic:
        y=x.replace('\n','')
        picNames.append(y)
print(picNames)


#Ventana
root = Tk()

root.title("BayArt! - Carrousel")
root.attributes("-fullscreen",TRUE)
root.configure(bg="#242424")

root.update()
rootWidth = root.winfo_width()
rootHeight = root.winfo_height()

var = open("var.txt","r")
rotateEnable = str(var.readline()[:-1])
infoEnable = str(var.readline()[:-1])
timeRotation = int(var.readline()[:-1])


imageUrl = []
index = 0
actualUrl = var.readline()[:-1]

while(actualUrl!=""):
	imageUrl.append(actualUrl)
	actualUrl = var.readline()[:-1]

var.close()

def resizeFullScreenImage(urlImage):
        
    image_no_resized = Image.open(urlImage)
    width, height = image_no_resized.size
    if(rootWidth / width < rootHeight / height):
        image_resized = image_no_resized.resize((int(rootWidth*0.8),int((height/width*rootWidth)*0.8)),Image.ANTIALIAS)
    else:
        image_resized = image_no_resized.resize((int((width/height*rootHeight)*0.8),int(rootHeight*0.8)),Image.ANTIALIAS)

    return image_resized

def rotate():
        global main_image
        main_image = ImageTk.PhotoImage(resizeFullScreenImage(os.path.dirname(os.path.abspath(__file__))+'/images/'+imageUrl[index]))
        main_username=usernames[index]
        main_picName=picNames[index]
        labelimagemain.configure(image=main_image)
        artistLabel.configure(text=main_username)
        pictureNameLabel.configure(text=main_picName)

        if(rotateEnable == 'True'):
                 timer = Timer(timeRotation,rotate_right).start()

def rotate_left():
        global index
        if(index-1 >= 0):
                index -= 1
        else:
                index = len(imageUrl)-1
        rotate()

def rotate_right():
        global index
        if(index+1 < len(imageUrl)):
                index += 1
        else:
                index = 0
        rotate()


buttons_status = True
def change_display_buttons():
        global buttons_status
        global label_left_arrow
        global label_right_arrow
        
        if buttons_status:
                label_left_arrow.place(relx = -1, rely = -1, anchor = CENTER)
                label_right_arrow.place(relx = -1, rely = -1, anchor = CENTER)
                hide_show_button['text'] = 'Show Buttons'
        else:
                label_left_arrow.place(relx = 0.03, rely = 0.5, anchor = CENTER)
                label_right_arrow.place(relx = 0.97, rely = 0.5, anchor = CENTER)
                hide_show_button['text'] = 'Hide Buttons'       
        buttons_status  = not buttons_status 

info_status = True
def change_display_info():
        global info_status
        global info_container
        global pictureNameLabel
        global artistLabel
        global button_close
        
        if info_status:
                info_container.place(relx = -1, rely = -1, anchor = CENTER)
                pictureNameLabel.place(relx = -1, rely = -1, anchor = CENTER)
                artistLabel.place(relx = -1, rely = -1, anchor = CENTER)
                button_close['bg'] = "#242424"
                button_close['activebackground'] = "#242424"
                hide_show_info['text'] = 'Show Info'
        else:
                info_container.place(relx = 0.5, rely = 0.05, anchor = CENTER)
                pictureNameLabel.place(relx = 0.5, rely = 0.035, anchor = CENTER)
                artistLabel.place(relx = 0.5, rely = 0.08, anchor = CENTER)
                button_close['bg'] = "#3d3d3d"
                button_close['activebackground'] = "#3d3d3d"
                hide_show_info['text'] = 'Hide Info'
        info_status  = not info_status 
    
main_image = ImageTk.PhotoImage(resizeFullScreenImage(os.path.dirname(os.path.abspath(__file__))+'/images/'+imageUrl[index]))
main_username=usernames[0]
main_picName=picNames[0]

labelimagemain = Label(root, image=main_image, border=0, bg="#242424")
labelimagemain.place(relx = 0.5, rely = 0.5, relwidth=1, relheight=1, anchor = CENTER)

if rotateEnable == 'False':
        #FlechaIzq
        left_arrow_no_resized = Image.open(os.path.dirname(os.path.abspath(__file__))+'/logos/left_arrow.png')

        left_arrow_resized = left_arrow_no_resized.resize((int(rootWidth/40),int(rootHeight/15)),Image.ANTIALIAS)

        left_arrow = ImageTk.PhotoImage(left_arrow_resized)

        label_left_arrow = Button(root ,image=left_arrow, command=rotate_left, border=0,activebackground="#242424", bg="#242424")
        label_left_arrow.place(relx = 0.03, rely = 0.5, anchor = CENTER)
        
        #FlechaDer
        right_arrow_no_resized = Image.open(os.path.dirname(os.path.abspath(__file__))+'/logos/right_arrow.png')

        right_arrow_resized = right_arrow_no_resized.resize((int(rootWidth/40),int(rootHeight/15)),Image.ANTIALIAS)

        right_arrow = ImageTk.PhotoImage(right_arrow_resized)

        label_right_arrow = Button(root, image=right_arrow, command=rotate_right,activebackground="#242424", border=0, bg="#242424")
        label_right_arrow.place(relx = 0.97, rely = 0.5, anchor = CENTER)

        #Hide Show Buttons
        hide_show_button = Button(root,text="Hide Buttons",font=("Verdana", 10, "bold"), command=change_display_buttons, border=0, bg="#00a797", fg="#242424" )
        hide_show_button.place(relx = 0.95, rely = 0.98, anchor = CENTER)
else:
        #Loop
        timer = Timer(timeRotation,rotate_right).start()

if infoEnable == 'True':
        info_container = Frame(root, bg="#3d3d3d", width=int(rootWidth), height=int(rootHeight/10))
        info_container.place(relx = 0.5, rely = 0.05, anchor = CENTER)

        artistLabel=Label(root,text=main_username, font=("Verdana", 12, "bold"), bg="#3d3d3d", fg="white")
        artistLabel.place(relx = 0.5, rely = 0.08, anchor = CENTER)

        pictureNameLabel=Label(root,text=main_picName, font=("Verdana", 30, "bold"), bg="#3d3d3d", fg="white")
        pictureNameLabel.place(relx = 0.5, rely = 0.035, anchor = CENTER)

        #Hide Show Info
        hide_show_info = Button(root,text="Hide Info",font=("Verdana", 10, "bold"), command=change_display_info, border=0, bg="#00a797", fg="#242424" )
        hide_show_info.place(relx = 0.04, rely = 0.98, anchor = CENTER)
        

#Boton cerrar
        
def openSettings():
    root.destroy()
    os.system('SettingsBayArt.py')
        
close_no_resized = Image.open(os.path.dirname(os.path.abspath(__file__))+'/logos/cancel.png')
close_resized = close_no_resized.resize((int(rootWidth/27.2),int(rootHeight/15.36)),Image.ANTIALIAS)
close_image = ImageTk.PhotoImage(close_resized)

button_close = Button(root, command=openSettings, image=close_image,highlightthickness = 0, bd = 0)
button_close.place(relx=0.98, rely=0.02,anchor=NE)

if infoEnable == 'True':
        button_close['bg'] = "#3d3d3d"
        button_close['activebackground'] = "#3d3d3d"
else:
        button_close['bg'] = "#242424"
        button_close['activebackground'] = "#242424"

  
root.mainloop()


