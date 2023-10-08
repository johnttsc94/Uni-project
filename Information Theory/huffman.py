'''
    Member List
1) Alvin Kua Chee Shern (Leader)
2) Foo Haw Liang
3) Grayson Goh Jin Yi
4) Siah Kah Chuan
'''
import math #to allow calculation for log base 2
from tkinter import * #bring GUI into application

class huff:
    probability = []
    def __init__(self, frequency,length):
        self.frequency = frequency
        self.length = length

    #calculate the probability of given frequency
    def calcProbability(self):
        i = 0
        for freq in frequency:
            self.probability.insert(i,round((freq[1]/self.length), 4))
            i+=1
        return self.probability

    #rearrange position of the value
    def position(self, value, index):
        for j in range(len(self.probability)):
            if(value >= self.probability[j]):
                return j
        return index-1

    #built a encoded code word
    def encoding(self):
        self.calcProbability()
        num = len(self.probability)
        codeWord = ['']*num

        #number of times that need to perform adding
        for i in range(num-2):
            #add last 2 probability
            val = self.probability[num-i-1] + self.probability[num-i-2]
            #if both leaf node is not empty
            if (codeWord[num - i - 1] != '' and codeWord[num - i - 2] != ''):
                codeWord[-1] = ['0' + symbol for symbol in codeWord[-1]]
                codeWord[-2] = ['1' + symbol for symbol in codeWord[-2]]
            # if right leaf node is not empty
            elif (codeWord[num - i - 1] != ''):
                codeWord[num - i - 2] = '0'
                codeWord[-1] = ['1' + symbol for symbol in codeWord[-1]]
            # if left leaf node is not empty
            elif (codeWord[num - i - 2] != ''):
                codeWord[num - i - 1] = '1'
                codeWord[-2] = ['0' + symbol for symbol in codeWord[-2]]
            # if both leaf node is empty
            else:
                codeWord[num - i - 1] = '1'
                codeWord[num - i - 2] = '0'


            position = self.position(val, i)

            probability = self.probability[0:(len(self.probability) - 2)]


            probability.insert(position, val)

            #arrange the code in a proper leaf node manner
            if (isinstance(codeWord[num - i - 2], list) and isinstance(codeWord[num - i - 1], list)):
                complete_code = codeWord[num - i - 1] + codeWord[num - i - 2]
            elif (isinstance(codeWord[num - i - 2], list)):
                complete_code = codeWord[num - i - 2] + [codeWord[num - i - 1]]

            elif (isinstance(codeWord[num - i - 1], list)):
                complete_code = codeWord[num - i - 1] + [codeWord[num - i - 2]]

            else:
                complete_code = [codeWord[num - i - 2], codeWord[num - i - 1]]


            codeWord = codeWord[0:(len(codeWord) - 2)]

            codeWord.insert(position, complete_code)

        #append back to main node
        codeWord[0] = ['0' + symbol for symbol in codeWord[0]]
        codeWord[1] = ['1' + symbol for symbol in codeWord[1]]
        #if right node of main node is empty
        if (len(codeWord[1]) == 0):
            codeWord[1] = '1'

        count = 0
        final_code = [''] * num
        #read in reverse manner
        for i in range(2):
            for j in range(len(codeWord[i])):
                final_code[count] = codeWord[i][j]
                count += 1

        final_code = sorted(final_code, key=len)
        return final_code

    def efficiency(self,codeL):
        #initialize some variable
        #average code length
        acl = 0;
        entrophy = 0
        #text to show calculation step of acl
        text = ""
        # text to show calculation step of entrophy
        text2 = ""
        for i in range(len(self.probability)):
            #calculate for average code word length
            acl += self.probability[i] * codeL[i]
            # calculate for entrophy
            entrophy += self.probability[i] * math.log2(1/self.probability[i])
            if i != (len(self.probability) - 1):
                text += str(self.probability[i])+'('+str(codeL[i])+')'+ ' + '
                text2 += str(self.probability[i])+' * log\u2082(1/'+ str(self.probability[i])+') + '
            else:
                text += str(self.probability[i]) + '(' + str(codeL[i]) + ')'
                text2 += str(self.probability[i]) + ' * log\u2082(1/' + str(self.probability[i]) + ')'
        #calculate for efficiency
        result = round((entrophy / acl) * 100, 2);
        '''
        print("Average Code Word Length = ",text,"=",acl,'bits/symbol')
        print("Entrophy = ",text2,"=",round(entrophy,4),'bits/symbol')
        
        print("Efficiency = ",round(acl,4),"/",round(entrophy,4)," = ",result,"%")
        '''
        outputText = "Average Code Word Length = "+text+" = "+str(acl)+"bits/symbol\n\nEntrophy = "+text2+" = "+str(round(entrophy,4))+"bits/symbol\n\n"+"Efficiency = "+str(round(acl,4))+"/"+str(round(entrophy,4))+" = "+str(result)+"%"
        return outputText

#get a text fragment from user
text = input("Enter the text fragment to generate Huffman encoding table: ")

#check if text is empty
if not text:
    raise SystemExit("Please enter something")

#check if text contain input other than alphabet
if not text.isalpha():
    raise SystemExit("Please enter alphabet only")

frequency = {}
#loop through every character in text fragment to record number of a single character appears in the text fragment
for char in text:
    #if the character exist as a key of dictionary, plus one to the content
    if char in frequency.keys():
        frequency[char] += 1
    # else initialize the dictionary with char as key to be 1
    else:
        frequency[char] = 1
#sort the frequency dictionary in descending order
#sort according to frequency of character instead of order of character
    #achieve through explicitly state the short condition checking at lambda
frequency = sorted(frequency.items(),key = lambda frequency : frequency[1], reverse=True)
#print(frequency)


huffC = huff(frequency,len(text))
huffman_code = huffC.encoding()
print(' Char | Probability | Code Word | Code Word Length ')
print('--------------------------------------------------')

#keep track code word length
codeLength =[]
#table header
tableArray = [["Character","Probability","Code Word", "Code Word Length"]]
for id,char in enumerate(frequency):
    if huffman_code[id]=='':
        print(' %-4r |%12s' % (char[0], 1))
        continue
    print(' %4r | %9s/%1s | %9s | %14s' % (char[0], frequency[id][1], len(text),  huffman_code[id], len(huffman_code[id])))
    codeLength.append(len(huffman_code[id]))
    #store the result in table content
    tableArray.append([char[0], str(frequency[id][1])+'/'+str(len(text)),  huffman_code[id], len(huffman_code[id])])

output = huffC.efficiency(codeLength)
print(output)

#a class to generate table GUI
class Table:

    def __init__(self, window):

        # code for creating table
        for i in range(total_rows):
            for j in range(total_columns):
                self.e = Entry(window, width=20,font=('Arial', 16, 'bold'))
                self.e.grid(row=i, column=j)
                self.e.insert(END, tableArray[i][j])
                self.e.config(state=DISABLED)

        #code for display calculation step
        self.f = Text(window,height=10,font=('Arial', 12))
        self.f.grid(row=total_rows+1, columnspan=total_columns,sticky='nsew')
        self.f.insert(END, output)
        self.f.config(state=DISABLED,bg='orange')

# find total number of rows and
# columns in list
total_rows = len(tableArray)
total_columns = len(tableArray[0])

# create window
window = Tk()
t = Table(window)
window.mainloop()